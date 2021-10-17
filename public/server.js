const app = require('express')();
const server = require('http').createServer(app);
const io = require('socket.io')(server);

io.on('connection', socket => {
    console.log('Un utilisateur s\'est connecté.');

    socket.on('disconnect', _ => {
        console.log('User disconnected.');
    });

    socket.on('chat', msg => {
        io.emit('chat', msg);
    });

});

server.listen(3000, _ => {
    console.log('Ecoute sur le port 3000.');
});