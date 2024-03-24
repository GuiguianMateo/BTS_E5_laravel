@extends('layouts.app')

@section('content')
<div class="container"><br>
    <ul class="list-group">
        @forelse ($users as $user)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    {{ $user->id }} -   {{ $user->name }} {{ $user->firstname }}
                </div>
            </div>
        </li>
        @empty
        <li class="list-group-item">
            {{ __('Aucun client connu')}}
        </li>
        @endforelse
    </ul>
</div>
@endsection
