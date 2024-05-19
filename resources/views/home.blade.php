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

                    @foreach($itens as $item)

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nome }}</h5>
                        <p class="card-text">
                            <img src="{{ $item->imagem }}" alt="{{ $item->nome }}" class="img-thumbnail" style="max-width: 200px;">
                            <br>
                            <strong>Tipo de Documento:</strong> {{ $item->tipo_de_documento }}
                            <br>
                            <strong>Descrição:</strong> {{ $item->descricao }}
                            <br>
                            <strong>Local de Encontrado:</strong> {{ $item->local_de_encontrado }}
                            <br>
                            <strong>Registador:</strong> {{ $item->registador }}
                            <br>
                            <strong>Contacto:</strong> {{ $item->contacto }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection