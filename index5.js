const express = require('express');
const { createServer } = require('node:http');
const { join } = require('node:path');
const { Server } = require('socket.io');

const app = express();
const server = createServer(app);
const io = new Server(server, {
  cors: {
    origin: true,
    credentials: true,
  },
  allowEIO3: true,
});

app.get('/', (req, res) => {
  res.sendFile(join(__dirname, 'index5.html'));
});

io.on('connection', (socket) => {
  console.log('a user connected');
  socket.on('foo', function (data) {
    console.log('here we are in action event and data is: ' + data);
  });
  socket.on('get-user-info', (data) => {
    console.log('get-user-info');
    console.log(data);
  });
  socket.on('chat message', (msg) => {
    io.emit('chat_broadcast_message', msg);
  });
  socket.on('send_erp_order_resync_event', (msg) => {
    io.emit('send_erp_order_resync_event_broadcast', msg.client_id);
  });
  socket.on('event_customer_6', (msg) => {
    io.emit('event_broadcast_customer_6', msg);
  });
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

server.listen(3000, () => {
  console.log('server running at http://localhost:3000');
});
