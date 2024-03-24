@extends('layouts.app')

@section('content')
<div class="container"><br>
    <a href="{{ route('practicien.create') }}" class="btn btn-primary mb-3">Ajouter un Practicien</a>
    <ul class="list-group">
        @forelse ($practiciens as $practicien)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    {{ $practicien->id }} - {{ $practicien->name }} {{ $practicien->job }}
                </div>
            </div>
        </li>
        @empty
        <li class="list-group-item">
            {{ __('Aucun practicien connu')}}
        </li>
        @endforelse
    </ul>
</div>
@endsection
