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
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('userProfile', ['userId' => $user->id]) }}">профиль клиента</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
