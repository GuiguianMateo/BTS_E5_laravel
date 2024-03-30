@extends('layouts.app')

@section('content')
<div class="container"><br>
    <a href="{{ route('consultation.create') }}" class="btn btn-primary mb-3">Ajouter une Consultation</a>
    <ul class="list-group">
        @forelse ($consultations as $consultation)
            @if ($consultation->accept == 1)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{ $consultation->id }} - {{ $consultation->date }}
                        </div>
                        <a href="{{ route('consultation.edit', $consultation->id) }}" class="btn btn-primary">Modifier</a>
                    </div>
                </li>
            @endif
        @empty
            <li class="list-group-item">
                {{ __('Aucune consultation connue')}}
            </li>
        @endforelse
    </ul>
</div>
@endsection
