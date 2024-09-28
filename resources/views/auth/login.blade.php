@extends('my templates.main')

@section('main')
    <div class="row mt-4">
        <h1>Вход в систему</h1>
    </div>
    <form action="{{ route('loginAction') }}" method="post">
        @csrf
        @error('auth_error')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="phone" class="form-label">Ваш телефон</label>
            <input type="text" name="phone" value="{{ old('phone', '+')}}" class="form-control @error('phone') is-invalid @enderror" rows="1" placeholder="Введите телефон в международном формате">
            @error('phone')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" value="{{ old('password')}}" class="form-control @error('password') is-invalid @enderror" rows="1" placeholder="Введите пароль">
            @error('password')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </form>
    <div class="mb-3">
        <a href="{{ route('registerForm') }}"><button class="btn btn-primary">Регистрация</button></a>
    </div>
@endsection
