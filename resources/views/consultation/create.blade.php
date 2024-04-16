@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Création d'une consultation</p>
    @if(auth()->user()->client == 0)

        <form action="{{ route('consultation.store') }}" method="post">
            @csrf
            @method("post")

            <div class="mb-3">
                <label for="date" class="form-label">Date de la consultation</label>

                <input type="date" class="form-control" name="date">
                @error("date")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id">Choisir un type de consultation</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option value="">Veuillez choisir un type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-type-id="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="praticien_id">Choisir Praticien</label>
                <select class="form-select" name="praticien_id" id="praticien_id">
                    <option value="">Veuillez choisir un praticien</option>
                    {{-- Les options seront ajoutées dynamiquement ici en utilisant JavaScript --}}
                </select>
                @error('praticien_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <script>
                document.getElementById('type_id').addEventListener('change', function() {
                    var typeId = this.value;
                    var selectPraticien = document.getElementById('praticien_id');
                    selectPraticien.innerHTML = ''; // Efface les options précédentes
                    var options = {!! json_encode($praticiens) !!};
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].type_id == typeId) {
                            var option = document.createElement('option');
                            option.value = options[i].id;
                            option.text = options[i].name;
                            selectPraticien.add(option);
                        }
                    }
                });
            </script>

            <div class="mb-3">
                <label for="user_id">Choisir Client</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option value="type">Veuillez choisir un client</option>
                    @foreach($users as $user)
                        @if($user->client == 1)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="hidden">
                <label for="delay" class="form-label">retard</label>

                <input type="boolean" class="form-control" name="delay" value="0">
                @error("delay")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>

    @else

        <form action="{{ route('demande.store') }}" method="post">
            @csrf
            @method("post")

            <div class="mb-3">
                <label for="date" class="form-label">Date de la consultation</label>

                <input type="date" class="form-control" name="date">
                @error("date")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id">Choisir un type de consultation</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option value="type">Veuillez choisir un type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-type-id="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="praticien_id">Choisir Praticien</label>
                <select class="form-select" name="praticien_id" id="praticien_id">
                    <option value="">Veuillez choisir un praticien</option>
                    {{-- Les options seront ajoutées dynamiquement ici en utilisant JavaScript --}}
                </select>
                @error('praticien_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <script>
                document.getElementById('type_id').addEventListener('change', function() {
                    var typeId = this.value;
                    var selectPraticien = document.getElementById('praticien_id');
                    selectPraticien.innerHTML = ''; // Efface les options précédentes
                    var options = {!! json_encode($praticiens) !!};
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].type_id == typeId) {
                            var option = document.createElement('option');
                            option.value = options[i].id;
                            option.text = options[i].name;
                            selectPraticien.add(option);
                        }
                    }
                });
            </script>

            <div class="hidden">
                <label for="user_id">Choisir Client</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option value="{{ auth()->user()->id }}">Compte utilisé</option>
                    @foreach($users as $user)
                        @if($user->client == 1)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="hidden">
                <label for="delay" class="form-label">retard</label>

                <input type="boolean" class="form-control" name="delay" value="0">
                @error("delay")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>

    @endif
</div>
@endsection
