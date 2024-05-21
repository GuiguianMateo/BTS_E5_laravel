@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Modification d'une consultation</p>
    <form action="{{ route('consultation.update', $consultation->id) }}" method="post">
        @csrf
        @method("put")

        <div class="mb-3">
            <label for="date" class="form-label">Date de la consultation</label>

            <input type="date" class="form-control" name="date" value="{{ $consultation->date }}">
            @error("date")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id">Choisir un type de consultation</label>
            <select class="form-select" name="type_id" value="{{ $consultation->type_id }}">
                <option value="{{ $consultation->type_id }}">{{ $consultation->type->name }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="praticien_id">Choisir Praticien</label>
            <select class="form-select" name="praticien_id" id="praticien_id">
                @foreach ($praticiens as $praticien)
                    <option value="{{ $praticien->id }}" {{ $praticien->id == $consultation->praticien_id ? 'selected' : '' }}>
                        {{ $praticien->name }}
                    </option>
                @endforeach
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
                <option value="{{ $consultation->user_id }}">{{ $consultation->user->name }}</option>
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

        <div class="mb-3">
            <label for="label">Retard</label><br>
            <label for="delay" class="form-label">OUI</label>
            <input type="radio" class="form-check-input" name="delay" value="1" {{ $consultation->delay == 1 ? 'checked'   : '' }}>
            <br>
            <label for="delay" class="form-label">NON</label>
            <input type="radio" class="form-check-input" name="delay" value="0" {{ $consultation->delay == 0 ? 'checked'   : '' }}>
            @error("delay")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
