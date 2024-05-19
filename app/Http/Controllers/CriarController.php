<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;

class CriarController extends Controller
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

        return view('criar', $user);
    }


    public function criar(Request $request)
    {
        // Access the form data using $request->all()
        $data = $request->all();
        $user = Auth::user();

        // Perform any necessary actions using the $user variable

        // Validate the form data
        $request->validate([
            'nome' => 'required', // Replace with the desired validation rules for the 'nome' field
            'imagem' => 'required|image|mimes:jpeg,png,gif|max:5000', // Replace with the desired validation rules for the 'imagem' field
            'tipo_de_documento' => 'required', // Replace with the desired validation rules for the 'tipo_de_documento' field
            'descricao' => 'nullable', // Replace with the desired validation rules for the 'descricao' field
            'local_de_encontrado' => 'required', // Replace with the desired validation rules for the 'local_de_encontrado' field
            'contacto' => 'required|numeric', // Replace with the desired validation rules for the 'contacto' field
        ]);

        // Handle image upload and save to storage
        if ($request->hasFile('imagem')) {
            $image = $request->file('imagem');
            $imagePath = Storage::put('/public/imagem', $image); // Save the image to the 'images' directory
        } else {
            $imagePath = null; // Set the image path to null if no image is provided
        }

        // Create a new item using the Item model
        $item = new Item();
        $item->nome = $data['nome']; // Replace with the desired item name
        $item->imagem = $imagePath; // Set the image path
        $item->tipo_de_documento = $data['tipo_de_documento']; // Replace with the desired item type
        $item->descricao = $data['descricao']; // Replace with the desired item description
        $item->local_de_encontrado = $data['local_de_encontrado']; // Replace with the desired item location
        $item->registador = $user->id; // Use the user's ID to set the registador
        $item->contacto = $data['contacto']; // Replace with the desired item contact

        // Save the new item to the database
        $item->save();

        // Perform any necessary actions after saving the item

        // Return the 'home' view with the created item
        return redirect()->route('home'); // Replace 'criar' with the desired view name
    }
}
