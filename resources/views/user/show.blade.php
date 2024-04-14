@extends('layouts.app')

@section('content')
<div class="container">

    <div class="mb-3">
        <strong>name :</strong> {{ $user->name }}
    </div>
    <div class="mb-3">
        <strong>firstname :</strong> {{ $user->firstname }}
    </div>
    <div class="mb-3">
        <strong>email :</strong> {{ $user->email }}
    </div>
    <div class="mb-3">
        <strong>birthday :</strong> {{ $user->birthday }}
    </div>

</div>
@endsection
