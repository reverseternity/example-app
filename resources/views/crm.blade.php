@extends('my templates.main')

@section('main')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">№ клиента</th>
                <th scope="col">имя</th>
                <th scope="col">телефон</th>
                <th scope="col">эл.почта</th>
                <th scope="col">заказы</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
            <tr>
                <th scope="row">{{ $client->id }}</th>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td><a href="{{ route('clientProfile', ['clientId' => $client->id]) }}">профиль клиента</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
