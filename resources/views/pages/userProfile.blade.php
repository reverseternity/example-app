@extends('my templates.main')

@section('main')
    <div class="row mb-4">
        <h1 style="...">Профиль клиента</h1>
    </div>
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">ID:{{ $user->id }}</h6>
                <p class="card-text">Номер телефона: {{ $user->phone }}</p>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Место: {{ $user->ip }}</p>
                <a href="{{ route('index') }}" class="card-link">Заказы клиента</a>
                <a href="{{ route('editUserProfile', ['userId' => $user->id]) }}"><button class="btn btn-primary">изменить данные</button></a>
            </div>
        </div>
    <div class="row mb-4">
        <h3 style="...">Заявки клиента</h3>
    </div>
    @foreach ($user->orders as $order)
    <div class="card" style="width: 30rem; margin-bottom: 10px">
        <div class="card-body">
            <h5 class="card-title">{{ $order->title }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">ID заказа:{{ $order->id }} </h6>
            <p class="card-text">{{ $order->demand }}</p>
            <p class="card-text">{{ $order->date }} {{ $order->time }}</p>
            <p class="card-text">Способ связи: {{ $order->contact }}</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
    @endforeach
@endsection
