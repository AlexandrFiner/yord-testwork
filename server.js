const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
    cors: "*"
});

const subscriber = require('redis').createClient({
    host: 'redis',
    port: 6379,
    password: 'yord'
});

subscriber.pSubscribe('*', function (error, count) {

});

subscriber.on('pmessage', function(pattern, channel, message) {
    console.log(channel, message)
    io.emit('chat', message);
});

io.on('connection', function(socket){
    console.log('connection')
    subscriber.subscribe('chat');
});

const port = process.env.PORT || 5000;

http.listen(
    port,
    function() {
        console.log('Listen at ' + port);
    }
);
