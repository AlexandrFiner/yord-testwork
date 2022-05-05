@extends('main')

@section('title', 'Чат')
@section('content')
    <h1>Чат</h1>

    @if(Auth::check())
    <form id="sendMessage" action="/chat/send" method="post">
        @csrf
        <input type="text" name="message">
        <button type="submit">Отправить</button>
    </form>
    @else
        <div style="padding: 10px; background: #fd8f8f">
            <p>
                Чат доступен только авторизованым пользователям
            </p>
            <a href="/user/login">Авторизация</a> либо <a href="/user/register">Регистрация</a>
        </div>
    @endif

    <ul id="chat">
        @foreach($messages as $message)
            <li>
                <b>{{$message->author->email}}</b>
                <p>{{$message->content}}</p>
            </li>
        @endforeach
    </ul>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
    <script>
        $('form#sendMessage').submit(function (e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function() {
                console.log('success');
            }).fail(function() {
                console.log('fail');
            });
            $(this)[0].reset();
            e.preventDefault();
        });

        function appendMessage(data) {
            $('#chat').prepend(
                $('<li/>').append(
                    $('<b/>').text(data.message.author.email),
                    $('<p/>').text(data.message.content)
                )
            );
        }

        var socket = io('localhost:5000');

        socket.on('chat:message.sent', function (data) {
            appendMessage(data);
        });
    </script>
@endsection