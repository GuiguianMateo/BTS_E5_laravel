@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Ajout d'un practicien</p>
    <form action="{{ route('practicien.store') }}" method="post">
        @csrf
        @method("post")

        <div class="mb-3">
            <label for="name" class="form-label">Nom du Practicien</label>

            <input type="text" class="form-control" name="name">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="job" class="form-label">Métier du Practicien</label>

            <input type="text" class="form-control" name="job">
            @error("job")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crée</button>
    </form>
</div>
@endsection
