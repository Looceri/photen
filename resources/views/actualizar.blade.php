@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div id="selecionar">
                        <div class="card-header">{{ __('Selecionar Item') }}</div>

                        <div class="card-body">
                            <!-- Existing form code -->

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="items">Itens criados pelo usuário:</label>
                                    <select id="items" class="form-control">
                                        <!-- Populate the select options with user-created items -->
                                        @foreach ($itens as $item)
                                            <option value="{{ $item->id }}" id="itens">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" style="margin-top: 23px">
                                    <button id="select-item" class="btn btn-primary">Selecionar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="inputs" style="display: none">
                        <div class="card-header">{{ __('Actualizar Item') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('actualizar') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="nome"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                                    <div class="col-md-6">
                                        <input id="nome" type="text"
                                            class="form-control @error('nome') is-invalid @enderror" name="nome"
                                            value="{{ old('nome') }}" required>

                                        @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="imagem"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Imagem') }}</label>

                                    <div class="col-md-6">
                                        <input id="imagem" type="file"
                                            class="form-control @error('imagem') is-invalid @enderror" name="imagem"
                                            value="{{ old('imagem') }}">

                                        @error('imagem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tipo_de_documento"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Documento') }}</label>

                                    <div class="col-md-6">
                                        <select id="tipo_de_documento"
                                            class="form-control @error('tipo_de_documento') is-invalid @enderror"
                                            name="tipo_de_documento">
                                            <option value="">Selecione um tipo de documento</option>
                                            <option value="BI">Bilhete de Identidade</option>
                                            <option value="Passaporte">Passaporte</option>
                                            <option value="Cartao_de_eleitor">Cartao de eleitor</option>
                                            <!-- Add more options as needed -->
                                        </select>

                                        @error('tipo_de_documento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="local_de_encontrado"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Local de Encontrado') }}</label>

                                    <div class="col-md-6">
                                        <input id="local_de_encontrado" type="text"
                                            class="form-control @error('local_de_encontrado') is-invalid @enderror"
                                            name="local_de_encontrado" value="{{ old('local_de_encontrado') }}">

                                        @error('local_de_encontrado')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="descricao"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Descrição') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" rows="3">{{ old('descricao') }}</textarea>

                                        @error('descricao')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="contacto"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Contacto') }}</label>

                                    <div class="col-md-6">
                                        <input id="contacto" type="text"
                                            class="form-control @error('contacto') is-invalid @enderror" name="contacto"
                                            value="{{ old('contacto') }}">

                                        @error('contacto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4" style="display: inline;">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Actualizar') }}
                                        </button>

                                        <button type="button" class="btn btn-secondary" style="margin-left: 10px"
                                            id="cancelar">
                                            {{ __('Crancelar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add the following JavaScript code to the bottom of your HTML file -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectItems = document.getElementById('items');
            let item = undefined; // Declare and initialize the item variable

            selectItems.addEventListener('change', function() {
                const selectedItemValue = selectItems.value;
                item = selectedItemValue;
            });

            const selectButton = document.getElementById('select-item');
            const inputsDiv = document.getElementById('inputs');
            const selectDiv = document.getElementById('selecionar');

            selectButton.addEventListener('click', function() {
                if (item === undefined) {
                    alert('Por favor, selecione um item.'); // Display an alert message
                    return; // Exit the function if no item is selected
                }

                inputsDiv.style.display = 'block';
                selectDiv.style.display = 'none';
            });

            const cancelButton = document.getElementById('cancelar');

            cancelButton.addEventListener('click', function() {
                inputsDiv.style.display = 'none';
                selectDiv.style.display = 'block';
            });
        });
    </script>
@endsection
