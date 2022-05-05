@extends('main')

@section('title', 'Чат')
@section('content')
    <h1>Чат</h1>

    <ul>
        @foreach($messages as $message)
        <li>
            <b>{{$message->author->email}}</b>
            <span>{{$message->content}}</span>
        </li>
        @endforeach
    </ul>

    <form action="/chat/send" method="post">
        @csrf
        <input type="text" name="message">
        <button type="submit">Отправить</button>
    </form>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
    <script>

    </script>
@endsection