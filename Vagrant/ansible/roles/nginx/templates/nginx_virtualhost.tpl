server {
listen 80 default_server;
server_name {{server.ip}};

return https://{{server.ip}}$request_uri;
}
