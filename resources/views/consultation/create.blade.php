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
            <label for="limitedate" class="form-label">date limite de la consultation</label>

            <input type="date" class="form-control" name="limitedate">
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

        <!-- FAIRE IF POUR SAVOIR SI CEST UN CLIENT OU UN EMPLOYER QUI FAIT LE FORMULAIRE -> client:value=0 // employer:value=1-->
        <div class="hidden">
            <label for="accepter" class="form-label">accepter</label>

            <input type="boolean" class="form-control" name="accepter" value="1">
            @error("accepter")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crée</button>
    </form>
</div>
@endsection
