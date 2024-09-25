@extends('my templates.main')

@section('main')
    <div class="d-flex">
        <div class="card" style="width: 35rem;">
            <a href="{{ route('freeConsult') }}">
            <img src="{{ asset('my assets/pictures/freeconsult-test.png') }}" class="card-img-top" alt="...">
            </a>
            </div>
        </div>
    </div>
@endsection
