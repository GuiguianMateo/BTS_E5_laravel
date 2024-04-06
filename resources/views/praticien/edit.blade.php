@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Modification d'un praticien</p>
    <form action="{{ route('praticien.update', $praticien->id) }}" method="post">
        @csrf
        @method("put")

        <div class="mb-3">
            <label for="name" class="form-label">Nom du Praticien</label>

            <input type="text" class="form-control" name="name" value="{{ $praticien->name }}">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="job" class="form-label">Métier du Praticien</label>

            <input type="text" class="form-control" name="job" value="{{ $praticien->job }}">
            @error("job")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
