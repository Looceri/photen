<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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


    public function cria(array $data)
    {
        $user = Auth::user();

        // Perform any necessary actions using the $user variable

        // Handle image upload and save to storage
        if ($data['imagem']->hasFile('imagem')) {
            $image = $data['imagem']->file('imagem');
            $imagePath = Storage::put('images', $image); // Save the image to the 'images' directory
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

        // Return any necessary data or view
        return view('criar', compact('item')); // Replace 'criar' with the desired view name
    }
}
