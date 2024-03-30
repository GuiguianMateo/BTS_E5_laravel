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
                <div class="flex gap-2">
                    @can('practicien-edit')
                        <a href="{{ route('practicien.edit', $practicien->id) }}" class="btn btn-primary">Modifier</a>
                    @endcan
                    @can('practicien-delete')
                        <form action="{{ route('practicien.destroy', $practicien->id) }}" method="POST">
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
            {{ __('Aucun practicien connu')}}
        </li>
        @endforelse
    </ul>
</div>
@endsection
