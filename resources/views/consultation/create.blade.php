@extends('layouts.app')

@section('content')
<div class="container">
    <p class="flex text-xl justify-center my-5">Création d'une consultation</p>
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
                <option value="type">Veuillez choisir un type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        @if(auth()->user()->client == 0)
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
        @else
            <div class="hidden">
                <label for="user_id">Choisir Client</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option value="{{ auth()->user }}">Compte utilisé</option>
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
        @endif

        <div class="hidden">
            <label for="delay" class="form-label">retard</label>

            <input type="boolean" class="form-control" name="delay" value="0">
            @error("delay")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="hidden">
            <label for="accept" class="form-label">Accepter</label>
            <input type="radio" class="form-check-input" name="accept" value="1" {{ auth()->user()->client == 0 ? 'checked'   : '' }}>
            <br>
            <label for="accept" class="form-label">Refuser</label>
            <input type="radio" class="form-check-input" name="accept" value="0" {{ auth()->user()->client == 1 ? 'checked'   : '' }}>
            @error("accept")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
