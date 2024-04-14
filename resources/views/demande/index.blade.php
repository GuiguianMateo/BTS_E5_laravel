@extends('layouts.app')

@section('content')
<div class="container"><br>
    <ul class="list-group">
        @forelse ($demandes as $demande)
            <li class="list-group-item">
                <div class="sm:flex justify-between items-center">
                    <div class="flex gap-6">
                        <div class='min-w-40 text-center'>{{ $demande->user->name}}</div>
                        <div class='min-w-40 text-center'>{{ $demande->type->name }}</div>
                        <div class='min-w-40 text-center'>{{ $demande->date }}</div>
                    </div>
                    <div class="flex justify-center gap-2">
                    @can('demande-accept')
                    <form action="{{ route('demande.accept', $demande->id) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Accepter</button>
                    </form>
                    @endcan
                    @can('demande-reject')
                        <form action="{{ route('demande.destroy', $demande->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Refuser</button>
                        </form>
                    @endcan
                    </div>
                </div>
            </li>
        @empty
            <li class="list-group-item">
                {{ __('Aucune demande connue')}}
            </li>
        @endforelse
    </ul>
</div>
@endsection
