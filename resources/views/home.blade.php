@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Itens Perdidos') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @php
                            // Use Laravel's Eloquent ORM to fetch items from the database
                            $itens = App\Models\Item::where('status', true)->get();
                        @endphp

                        @foreach ($itens as $item)
                            <div class="card-body">
                                <h3 class="card-title">{{ $item->nome }}</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="storage/{{ substr($item->imagem, 7)}}" alt="Sem imagem" class="img-thumbnail"
                                            style="max-width: 200px; height: auto;">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-text">
                                            <strong>Tipo de Documento:</strong>{{ $item->tipo_de_documento }}
                                            <br>
                                            <strong>Descrição:</strong> {{ $item->descricao }}
                                            <br>
                                            <strong>Local de Encontrado:</strong> {{ $item->local_de_encontrado }}
                                            <br>
                                            <strong>Registador:</strong>
                                            @php
                                                // Use Laravel's Eloquent ORM to fetch the user associated with the registador ID
                                                $registador = App\Models\User::find($item->registador);
                                                echo $registador ? $registador->name : 'N/A';
                                            @endphp
                                            <br>
                                            <strong>Contacto:</strong> {{ $item->contacto }}
                                            <br>
                                            <strong>Email:</strong>
                                            @php
                                                // Use Laravel's Eloquent ORM to fetch the user associated with the registador ID
                                                $registador = App\Models\User::find($item->registador);
                                                echo $registador ? $registador->email : 'N/A';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
