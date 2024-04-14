@extends('layouts.app')

@section('content')
<div class="container"><br>
    @can('praticien-create')
        <a href="{{ route('praticien.create') }}" class="btn btn-primary mb-3">Ajouter un Praticien</a>
    @endcan
    <ul class="list-group">
        @forelse ($praticiens as $praticien)
        <li class="list-group-item">
            <div class="sm:flex justify-between align-items-center">
                <div class="flex gap-6">
                    <div class='min-w-40 text-center'>{{ $praticien->name}}</div>
                    <div class='min-w-40 text-center'>{{ $praticien->job }}</div>
                </div>
                <div class="flex justify-center gap-2">
                    @can('praticien-edit')
                        <a href="{{ route('praticien.edit', $praticien->id) }}" class="btn btn-primary">Modifier</a>
                    @endcan
                    @can('praticien-delete')
                        <form action="{{ route('praticien.destroy', $praticien->id) }}" method="POST">
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
            {{ __('Aucun praticien connu')}}
        </li>
        @endforelse
    </ul>
</div>
@endsection
