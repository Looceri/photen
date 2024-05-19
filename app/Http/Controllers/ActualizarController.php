<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

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

            return view('actualizar', $user, ['itens' => Item::orderBy('created_at','DESC')]);

        }


}
