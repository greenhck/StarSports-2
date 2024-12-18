const http = require('http');
const httpProxy = require('http-proxy');

// Create a proxy server
const proxy = httpProxy.createProxyServer({});
const server = http.createServer((req, res) => {
    proxy.web(req, res, { target: 'http://119.156.26.155:8000/play/a069/index.m3u8' });
});

server.listen(8080, () => {
    console.log('Proxy server running at http://localhost:8080');
});
