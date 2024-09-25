@extends('my templates.main')

@section('main')
    <div class="row mt-4">
        <h1>Регистрация</h1>
    </div>
    <form action="{{ route('registerAction') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" rows="1" placeholder="Как к Вам обращаться?">
            @error('name')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
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
            <input type="password" name="password" value="{{ old('password')}}" class="form-control rows="1" placeholder="Введите пароль">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Повторение пароля</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation')}}" class="form-control rows="1" placeholder="Повторите пароль">
        </div>

        <div class="mb-5">
            <button type="submit" name="staff" value="true" class="btn btn-primary">Отправить заявку</button>
        </div>
    </form>
@endsection
