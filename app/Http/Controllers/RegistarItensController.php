<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\Item;

class RegistarItensController extends Controller
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
        return view('register_itens');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

   

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'tring', 'ax:255'],
            'imagem' => ['required', 'image', 'imes:jpeg,png,jpg'],
            'tipo_de_documento' => ['nullable', 'tring', 'ax:255'],
            'descricao' => ['nullable', 'tring'],
            'local_de_encontrado' => ['nullable', 'tring', 'ax:255'],
            'egistador' => ['required', 'tring', 'ax:255'],
            'contacto' => ['required', 'tring', 'ax:255'],
        ]);
    }

    /**
     * Create a new item instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Item
     */
    
     protected function create(Item $data, Request $request)
    {
        // Handle uploaded image
        if ($request->hasFile('imagem')) {
            $image = $request->file('imagem');
            $imagePath = Storage::put('images', $image);
            
            // Resize and save the image
            Storage::put('thumbnails/'. $imagePath, $image);
        }
        
        // Create the item
        Item::create([
            'nome' => $data['nome'],
            'imagem' => isset($imagePath)? $imagePath : null,
            'tipo_de_documento' => $data['tipo_de_documento'],
            'descricao' => $data['descricao'],
            'local_de_encontrado' => $data['local_de_encontrado'],
            'registador' => $data['registador'],
            'contacto' => $data['contacto'],
        ]);
        
        return redirect()->route('home');
    }
}
