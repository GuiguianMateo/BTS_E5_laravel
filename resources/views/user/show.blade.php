@extends('layouts.app')

@section('content')
<div class=" bg-white mx-auto p-2 mt-5 max-w-96 border-2 rounded ">

    <div class="mb-3">
        <strong>Nom :</strong> {{ $user->name }}
    </div>
    <div class="mb-3">
        <strong>Prénom :</strong> {{ $user->firstname }}
    </div>
    <div class="mb-3">
        <strong>email :</strong> {{ $user->email }}
    </div>
    <div class="mb-3">
        <strong>Date de naissance :</strong> {{ $user->birthday }}
    </div>
    <div class="mb-3">
        <strong>sexe :</strong> {{ $user->gender }}
    </div>
</div>
@endsection
