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
                <option value="type">Veuillez choisir un type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="hidden">
            <label for="delay" class="form-label">retard</label>

            <input type="boolean" class="form-control" name="delay" value="{{ $consultation->delay }}">
            @error("delay")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class=>
            <label for="accept" class="form-label">Accepter</label>
            <input type="radio" class="form-check-input" name="accept" value="1" {{ auth()->user()->client == 0 ? 'checked'   : '' }}>
            <br>
            <label for="accept" class="form-label">Refuser</label>
            <input type="radio" class="form-check-input" name="accept" value="0" {{ auth()->user()->client == 1 ? 'checked'   : '' }}>
            @error("accept")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
