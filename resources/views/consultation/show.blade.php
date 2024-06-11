@extends('layouts.app')

@section('content')
<div class=" bg-white mx-auto p-2 mt-5 max-w-fit border-2 rounded ">
    <div class="mb-3">
        <strong>Date de la consultation :</strong> {{ $consultation->date }}
    </div>
    <div class="mb-3">
        <strong>Date de péremption de la consultation :</strong> {{ $consultation->deadline }}
    </div>
    <div class="mb-3">
        <strong>Nom du praticien :</strong> {{ $consultation->praticien->name }}
    </div>
    <div class="mb-3">
        <strong>Type de la consultation :</strong> {{ $consultation->type->name }}
    </div>
</div>
<ul class="list-group">
    @forelse ($prescriptions as $prescription)
            <li class="list-group-item">
                <div class="sm:flex justify-between items-center">
                    <div class="flex gap-6">
                        <div class='min-w-40 text-center'>{{ $prescription->user->name }}</div>
                        <div class='min-w-40 text-center'>{{ $prescription->type->name }}</div>
                        <div class='min-w-40 text-center'>{{ $prescription->deadline }}</div>
                    </div>
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('prescription.show', $prescription->id) }}" class="btn btn-success">Information</a>
                            <a href="{{ route('prescription.edit', $prescription->id) }}" class="btn btn-primary">Modifier</a>

                            <form action="{{ route('prescription.destroy', $prescription->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                    </div>
                </div>
            </li>
    @empty
        <li class="list-group-item">
            {{ __('Aucune consultation connue')}}
        </li>
    @endforelse
</ul>
@endsection
