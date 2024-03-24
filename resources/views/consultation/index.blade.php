@extends('layouts.app')

@section('content')
<div class="container"><br>
    <a href="{{ route('consultation.create') }}" class="btn btn-primary mb-3">Ajouter une Consultation</a>
    <ul class="list-group">
        @forelse ($consultations as $consultation)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    {{ $consultation->id }} -   {{ $consultation->date }}
                </div>
            </div>
        </li>
        @empty
        <li class="list-group-item">
            {{ __('Aucune consultation connu')}}
        </li>
        @endforelse
    </ul>
</div>
@endsection
