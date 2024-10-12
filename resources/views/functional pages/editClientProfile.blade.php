
@extends('my templates.main')

@section('main')
    <div class="row mb-4">
        <h3>Изменение данных клиента: {{ $client->name }}</h3>
    </div>
    <form action="{{ route('updateClient', ['clientId' => $client->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя клиента</label>
            <input type="text" name="name" value="{{ old('name', $client->name) }}" class="form-control @error('name') is-invalid @enderror" rows="1" placeholder="Как зовут клиента?">
            @error('name')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон клиента</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">📲</span>
                <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Введите телефон в международном формате" aria-label="Phone" aria-describedby="addon-wrapping">
                @error('phone')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email клиента</label>
            <input type="email" name="email" value="{{ old('email', $client->email) }}" class="form-control @error('email') is-invalid @enderror" rows="1" placeholder="Введите email клиента">
            @error('email')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mt-4">
            <button class="btn btn-success" type="submit">Изменить</button>
        </div>
    </form>
    <form action="{{ route('deleteClient', ['clientId' => $client->id]) }}" method="post">
        @csrf
        <div class="mt-4">
            <button class="btn btn-danger" type="submit">Удалить пользователя</button>
        </div>
    </form>
@endsection
