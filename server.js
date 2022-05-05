const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
    cors: "*"
});

const redis = require('redis');
const subscriber = redis.createClient({
    url: 'redis://redis:6379',
    password: 'yord',
});

subscriber.connect();

io.on('connection', function(socket){
    console.log('connection');
    subscriber.subscribe('chat', (message) => {
        console.log(message);
        message = JSON.parse(message);
        socket.emit('chat:'+message.event, message.data)
    });
});

const port = process.env.PORT || 5000;

http.listen(
    port,
    function() {
        console.log('Listen at port ' + port);
    }
);
