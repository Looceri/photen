<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ActualizarController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Use the $user variable to perform any necessary actions

        return view('actualizar', $user, ['itens' => Item::orderBy('created_at', 'DESC')]);
    }

    public function actualizar(Request $request)
    {
        // Access the form data using $request->all()
        $data = $request->all();
        $user = Auth::user();

        // Perform any necessary actions using the $user variable

        // Validate the form data
        $request->validate([ // Replace with the desired validation rules for the 'nome' field
            'nome' => 'required', // Replace with the desired validation rules for the 'nome' field
            'imagem' => 'nullable|max:5000', // Replace with the desired validation rules for the 'imagem' field
            'tipo_de_documento' => 'required', // Replace with the desired validation rules for the 'tipo_de_documento' field
            'descricao' => 'nullable', // Replace with the desired validation rules for the 'descricao' field
            'local_de_encontrado' => 'required', // Replace with the desired validation rules for the 'local_de_encontrado' field
            'contacto' => 'required|numeric', // Replace with the desired validation rules for the 'contacto' field
        ]);

        // Handle image upload and save to storage
        if ($request->hasFile('imagem')) {
            $image = $request->file('imagem');
            $imagePath = Storage::put('public/imagem', $image); // Save the image to the 'images' directory
        } else {
            $imagePath = 'public/'. $data['foto'];// Set the image path to null if no image is provided
        }


        $itemId = $data['item_id'];

        // Find the item in the database using the item ID
        $item = Item::find($itemId);

        // Update the item with the new values
        $item->nome = $data['nome']; // Replace with the desired item name
        $item->imagem = $imagePath; // Set the image path
        $item->tipo_de_documento = $data['tipo_de_documento']; // Replace with the desired item type
        $item->descricao = $data['descricao']; // Replace with the desired item description
        $item->local_de_encontrado = $data['local_de_encontrado']; // Replace with the desired item location
        $item->registador = $user->id; // Use the user's ID to set the registador
        $item->contacto = $data['contacto']; // Replace with the desired item contact

        if ($data['status'] === 'activo') {
            $item->status = true;
        } else {
            $item->status = false;
        }

        // Save the updated item to the database
        $item->save();


        return redirect()->route('home'); // Replace 'criar' with the desired view name

    }
}
