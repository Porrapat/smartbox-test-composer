const express = require('express');
const https = require('https');
const fs = require('fs'); // Required to read SSL certificate files
const { Server } = require('socket.io');
const { join } = require('node:path');

const app = express();
const port = 8443;

// respond with "hello world" when a GET request is made to the homepage
app.get('/', (req, res) => {
  res.sendFile(join(__dirname, 'index3.html'));
  // res.send('hello world');
});

// Load SSL certificate and key files
const options = {
  key: fs.readFileSync('/etc/letsencrypt/live/supalai-mui.porrapat.com/privkey.pem'), // Replace with the path to your private key file
  cert: fs.readFileSync('/etc/letsencrypt/live/supalai-mui.porrapat.com/fullchain.pem') // Replace with the path to your certificate file
};

// Create HTTPS server
const server = https.createServer(options, app);

const io = new Server(server);

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
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

  
server.listen(port, () => {
  console.log(`Example app listening on port ${port} over HTTPS`);
});

