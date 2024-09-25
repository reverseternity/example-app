@extends('my templates.main')

@section('main')
    <div class="row mt-4">
        <h1>Форма индивидуальной консультации</h1>
    </div>
    <form action="{{ route('createOrder') }}" method="post" enctype="multipart/form-data">
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
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">📲</span>
                <input type="text" name="phone" value="{{ old('phone', '+') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Введите телефон в международном формате" aria-label="Phone" aria-describedby="addon-wrapping">
                @error('phone')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="demand" class="form-label">Запрос</label>
            <textarea type="text" name="demand" class="form-control @error('demand') is-invalid @enderror" rows="3" placeholder="Сформулируйте Ваш запрос">{{ old('demand') }}</textarea>
            @error('demand')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Дата и время</span>
            <input type="text" name="date" value="{{ old('date') }}" aria-label="Дата" class="form-control @error('date') is-invalid @enderror" placeholder="Дата">
            @error('date')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="text" name="time" value="{{ old('time') }}" aria-label="Время" class="form-control @error('time') is-invalid @enderror" placeholder="Время">
            @error('time')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="option1" class="form-label">Формат консультации</label>
            <div>
                <input type="radio" name="contact" value="personally" id="option1" class="btn-check" autocomplete="off">
                <label class="btn" for="option1">Лично</label>

                <input type="radio" name="contact" value="call" id="option2" class="btn-check" autocomplete="off" checked>
                <label class="btn" for="option2">Звонок</label>

                <input type="radio" name="contact" value="videocall"id="option3" class="btn-check" autocomplete="off">
                <label class="btn" for="option3">Видеозвонок</label>
            </div>
        </div>
        <div class="mb-5">
            <button type="submit" name="title" value="Запрос на консультацию Любови Гордеевой" class="btn btn-primary">Отправить</button>
        </div>
    </form>
@endsection
