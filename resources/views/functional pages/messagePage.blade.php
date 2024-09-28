
@extends('my templates.main')

@section('main')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @error('auth_error')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="mt-3">
        <a href="{{ route('index') }}"><button class="btn btn-outline-primary">вернуться на главную</button></a>
    </div>
@endsection
