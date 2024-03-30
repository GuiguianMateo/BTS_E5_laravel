@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Modification d'un practicien</p>
    <form action="{{ route('practicien.update', $practicien->id) }}" method="post">
        @csrf
        @method("put")

        <div class="mb-3">
            <label for="name" class="form-label">Nom du Practicien</label>

            <input type="text" class="form-control" name="name" value="{{ $practicien->name }}">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="job" class="form-label">Métier du Practicien</label>

            <input type="text" class="form-control" name="job" value="{{ $practicien->job }}">
            @error("job")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
