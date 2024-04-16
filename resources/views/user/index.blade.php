@extends('layouts.app')

@section('content')
<div class="container"><br>
    <ul class="list-group">
        @forelse ($users as $user)
            @if (Auth::user()->client == 0)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex gap-6">
                            <div class='min-w-40 text-center'>{{ $user->name }}</div>
                            <div class='min-w-40 text-center'>{{ $user->email }}</div>
                            <div class='min-w-40 text-center'>{{ $user->firstname }}</div>
                        </div>
                        <a href="{{ route('client.show', $user->id) }}" class="btn btn-primary">Information</a>
                    </div>
                </li>
            @else
                @if (Auth::user()->id == $user->id)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex gap-6">
                                <div class='min-w-40 text-center'>{{ $user->name }}</div>
                                <div class='min-w-40 text-center'>{{ $user->email }}</div>
                                <div class='min-w-40 text-center'>{{ $user->firstname }}</div>
                            </div>
                            <a href="{{ route('client.show', $user->id) }}" class="btn btn-primary">Information</a>
                        </div>
                    </li>
                @endif
            @endif
        @empty
            <li class="list-group-item">
                {{ __('Aucun client connu')}}
            </li>
        @endforelse
    </ul>
</div>
@endsection
