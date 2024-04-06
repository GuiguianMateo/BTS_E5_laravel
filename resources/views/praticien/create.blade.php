@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Ajout d'un praticien</p>
    <form action="{{ route('praticien.store') }}" method="post">
        @csrf
        @method("post")

        <div class="mb-3">
            <label for="name" class="form-label">Nom du Praticien</label>

            <input type="text" class="form-control" name="name">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="job" class="form-label">Métier du Praticien</label>

            <input type="text" class="form-control" name="job">
            @error("job")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id">Branche du praticien</label>
            <select class="form-select" name="type_id" id="type_id">
                <option value="type">Veuillez choisir une branche</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
