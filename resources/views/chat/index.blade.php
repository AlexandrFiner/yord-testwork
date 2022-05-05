@extends('main')

@section('title', 'Чат')
@section('content')
    <h1>Чат</h1>

    <ul id="chat">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
    <script>
        function appendMessage(data) {
            $('#chat').append(
                $('<li/>').append(
                    $('<b/>').text(data.email),
                    $('<span/>').text(data.content)
                )
            );
        }

        var socket = io('localhost:5000');

        socket.on('chat:message.sent', function (data) {
            console.log(data);
        });
    </script>
@endsection