@extends('main')

@section('title', 'Авторизация')
@section('content')
    <h1>Авторизация</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post">
        @csrf
        <input type="text" name="email" placeholder="Почта" value="{{ old('email') }}">
        <input type="text" name="password" placeholder="Пароль">
        <button type="submit">Подтвердить</button>
    </form>
@endsection