var socket = io('http://localhost:3333');


socket.on('feed', function (e) {
  console.log(JSON.parse(e));
});
