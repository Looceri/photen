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
                            @php
                                $user = Auth::user();
                                // Use Laravel's Eloquent ORM to fetch items from the database
                                $itens = App\Models\Item::where('registador', $user->id)->get();
                            @endphp

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <img id="item-image" src="" alt="Imagem do item"
                                        style="max-width: 200px; display: none;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="items">Itens criados pelo usuário:</label>
                                    <select id="items" class="form-control">
                                        <!-- Populate the select options with user-created items -->
                                        <option value="">Selecione o documento</option>
                                        @foreach ($itens as $item)
                                            <option value="{{ json_encode($item) }}" id="itens">{{ $item->nome }}
                                            </option>
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
                            <form method="POST" action="{{ route('actualizar') }}" enctype = "multipart/form-data">
                                @csrf

                                <input id="item_id" type="text" class="form-control" name="item_id" hidden>
                                <input id="foto" type="text" class="form-control" name="foto" hidden>

                                <div class="row mb-3">
                                    <label for="nome"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                                    <div class="col-md-6">
                                        <input id="nome" type="text"
                                            class="form-control @error('nome') is-invalid @enderror" name="nome"
                                            required>

                                        @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="imagem" class="col-md-4 col-form-label text-md-end"
                                        id="fileInput">{{ __('Imagem') }}</label>

                                    <div class="col-md-6">
                                        <input id="imagem" type="file"
                                            class="form-control @error('imagem') is-invalid @enderror" name="imagem">

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
                                            name="local_de_encontrado">

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
                                        <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" rows="3"></textarea>

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
                                            class="form-control @error('contacto') is-invalid @enderror" name="contacto">

                                        @error('contacto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label
                                        class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status-ativo" value="activo" checked>
                                            <label class="form-check-label" for="status-ativo">Ativo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status-inativo" value="inativo">
                                            <label class="form-check-label" for="status-inativo">Inativo</label>
                                        </div>
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
        document.getElementById('items').addEventListener('change', function(event) {
            // Retrieve the selected option value
            var selectedValue = event.target.value;

            // Update the values of other input fields with the selected option value
            document.getElementById('nome').value = selectedValue;
            document.getElementById('imagem').value = ''; // Reset the image input value
            document.getElementById('tipo_de_documento').value = ''; // Reset the select option value
            document.getElementById('local_de_encontrado').value = '';
            document.getElementById('descricao').value = '';
            document.getElementById('contacto').value = '';

            // You can also fetch the details of the selected item from the database and populate the other input fields accordingly
        });
    </script>
@endsection
