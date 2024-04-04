const express = require('express');
const https = require('https');
const fs = require('fs'); // Required to read SSL certificate files

const app = express();
const port = 8443;

// respond with "hello world" when a GET request is made to the homepage
app.get('/', (req, res) => {
  res.send('hello world');
});

// Load SSL certificate and key files
const options = {
  key: fs.readFileSync('/etc/letsencrypt/live/supalai-mui.porrapat.com/privkey.pem'), // Replace with the path to your private key file
  cert: fs.readFileSync('/etc/letsencrypt/live/supalai-mui.porrapat.com/fullchain.pem') // Replace with the path to your certificate file
};

// Create HTTPS server
const server = https.createServer(options, app);

server.listen(port, () => {
  console.log(`Example app listening on port ${port} over HTTPS`);
});

