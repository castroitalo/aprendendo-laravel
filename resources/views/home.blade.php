@extends('layouts.main_layout');

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                {{-- Includes top bar --}}
                @include('partials.top_bar')

                @if (count($user_notes) === 0)
                    {{-- No notes available --}}
                    <div class="row mt-5">
                        <div class="col text-center">
                            <p class="display-6 mb-5 text-secondary opacity-50">You have no notes available!</p>
                            <a href="{{ route('newNote') }}" class="btn btn-secondary btn-lg p-3 px-5">
                                <i class="fa-regular fa-pen-to-square me-3"></i>Create Your First Note
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Notes available --}}
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('newNote') }}" class="btn btn-secondary px-3">
                            <i class="fa-regular fa-pen-to-square me-2"></i>New Note
                        </a>
                    </div>

                    {{-- Displays notes --}}
                    @foreach ($user_notes as $user_note)
                        @include('partials.note')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection