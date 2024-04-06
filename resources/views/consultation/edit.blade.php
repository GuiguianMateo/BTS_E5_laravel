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
            <label for="limitedate" class="form-label">date limite de la consultation</label>

            <input type="date" class="form-control" name="limitedate" value="{{ $consultation->limitedate }}">
            @error("limitedate")
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

        <div>
            <label for="accept" class="form-label">Accepter</label>
            <input type="radio" class="form-check-input" name="accept" value="1" {{ old('accept', $consultation->accept) == 1 ? 'checked' : '' }}>
            <br>
            <label for="accept" class="form-label">Refuser</label>
            <input type="radio" class="form-check-input" name="accept" value="0" {{ old('accept', $consultation->accept) == 0 ? 'checked' : '' }}>
            @error("accept")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
