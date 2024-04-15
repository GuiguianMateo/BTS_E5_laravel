@extends('layouts.app')

@section('content')
<div class="container"><br>
    <a href="{{ route('consultation.create') }}" class="btn btn-primary mb-3">Ajouter une Consultation</a>
    <ul class="list-group">
        @forelse ($consultations as $consultation)
            <li class="list-group-item">
                <div class="sm:flex justify-between items-center">
                    <div class="flex gap-6">
                        <div class='min-w-40 text-center'>{{ $consultation->user->name}}</div>
                        <div class='min-w-40 text-center'>{{ $consultation->type->name }}</div>
                        <div class='min-w-40 text-center'>{{ $consultation->deadline }}</div>
                    </div>
                    <div class="flex justify-center gap-2">
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
        @empty
            <li class="list-group-item">
                {{ __('Aucune consultation connue')}}
            </li>
        @endforelse
    </ul>
</div>
@endsection
