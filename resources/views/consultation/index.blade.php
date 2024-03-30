@extends('layouts.app')

@section('content')
<div class="container"><br>
    <a href="{{ route('consultation.create') }}" class="btn btn-primary mb-3">Ajouter une Consultation</a>
    <ul class="list-group">
        @forelse ($consultations as $consultation)
            {{-- @if ($consultation->accept == 0) --}}
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{ $consultation->id }} - {{ $consultation->date }}
                        </div>
                        <div class="flex gap-2">
                        @can('consultation-edit')
                            <a href="{{ route('consultation.edit', $consultation->id) }}" class="btn btn-primary">Modifier</a>
                        @endcan
                        @can('consultation-delete')
                            <form action="{{ route('consultation.destroy', $consultation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        @endcan
                        </div>

                    </div>
                </li>
            {{-- @endif --}}
        @empty
            <li class="list-group-item">
                {{ __('Aucune consultation connue')}}
            </li>
        @endforelse
    </ul>
</div>
@endsection
