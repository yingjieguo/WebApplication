var http = require("http"),
    socketio = require("socket.io"),
    fs = require("fs");


// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp) {
    // This callback runs when a new connection is made to our HTTP server.

    fs.readFile("chatroom.html", function(err, data) {
        // This callback runs when the client.html file has been read from the filesystem.

        if (err) return resp.writeHead(500);
        resp.writeHead(200);
        resp.end(data);
    });
});
app.listen(3456);

var io = socketio.listen(app);
var usernamelist = [];
var users = {};
var rooms = ['mainroom'];
var publicrooms = ['mainroom']; //public room list
var privateroominfo = {}; //to store private room password
var privateroomlist = []; //private room list
var blacklist = {};
var owners = {};
//var fontcolor = "#606c71";

io.sockets.on("connection", function(socket) {
    // This callback runs when a new Socket.IO connection is established.
    socket.on('message_to_server', function(data) {
        // This callback runs when the server receives a new message from the client.
        console.log("message: " + data["message"]); // log it to the Node.JS output
        var msg = data["message"];
        //emit it only to people in the room
        io.sockets.in(socket.room).emit("message_to_client", socket.username, msg);
    });
    socket.on("newUser", function(username) {
        if (usernamelist.indexOf(username) != -1) {
            socket.room = 'mainroom';
            socket.join('mainroom');
            socket.username = username;
            console.log(username + "already exists");
        } else {
            socket.username = username;
            socket.room = 'mainroom';
            users[username] = socket.room;
            socket.join('mainroom');
            usernamelist.push(username);
            console.log("Added User " + username);
            socket.emit('updatepublicroom', publicrooms, socket.room);
            socket.emit('updateprivateroom',privateroomlist,socket.room);
            socket.broadcast.to('mainroom').emit('message', username, 'has connected to the chat room');
            io.sockets.in(socket.room).emit('updateusers', socket.room, users);
            io.sockets.in(socket.room).emit('updateinfo',socket.room);
        }
    });

    socket.on('addPublicRoom',function(room,owner){
        publicrooms.push(room);
        rooms.push(room);
        owners[room] = owner;
        socket.emit('updatepublicroom', publicrooms, room)
    });

    socket.on('addPrivateRoom',function(room,password,owner){
        privateroomlist.push(room);
        rooms.push(room);
        owners[room] = owner;
        privateroominfo[room] = password;
        socket.emit('updateprivateroom',privateroomlist,room);
    });

    socket.on('override_priv', function(newowner, oldowner) {
        if (oldowner === owners[socket.room]) {
            owners[socket.room] = newowner;
            console.log("Owner of " + socket.room + " is now " + newowner);
            io.sockets.in(socket.room).emit('message',newowner,'is the new admin of this room');
        } else {
            console.log("need to implement");
        }

    });

    socket.on('switchPublicRoom', function(newroom, bannedlist) {
        if (bannedlist[newroom] != socket.username&&publicrooms.indexOf(newroom)!=-1) {
            var oldroom = socket.room;
            socket.leave(socket.room);
            socket.broadcast.to(socket.room).emit('message', socket.username, 'left this room');
            socket.join(newroom);
            users[socket.username] = newroom;
            socket.room = newroom;
            socket.broadcast.to(socket.room).emit('message', socket.username, 'entered this room');
            io.sockets.in(socket.room).emit('updateusers', socket.room, users);
            io.sockets.in(oldroom).emit('updateusers', oldroom, users);
            io.sockets.in(socket.room).emit('updateinfo',socket.room);
            io.sockets.in(oldroom).emit('updateinfo',oldroom);

        }else{
          console.log("You are banned by the admin");
        }
        // var oldroom = socket.room;
        // socket.leave(socket.room);
        // socket.broadcast.to(socket.room).emit('message',socket.username,'left this room');
        // socket.join(newroom);
        // users[socket.username]=newroom;
        // socket.room = newroom;
        // socket.broadcast.to(socket.room).emit('message',socket.username,'entered this room');
        // io.socket.in(socket.room).emit('updateusers',socket.room,users);
        // io.socket.in(socket.room).emit('updateusers',oldroom,users);
    });

    socket.on('switchprivateroom', function(newroom, pwd, bannedlist) {
        var truepass = privateroominfo[newroom];
        if (pwd == truepass && bannedlist[newroom] != socket.username) {
            var oldroom = socket.room;
            socket.leave(socket.room);
            socket.broadcast.to(socket.room).emit('message', socket.username, 'left this room');
            socket.join(newroom);
            users[socket.username] = newroom;
            socket.room = newroom;
            socket.broadcast.to(socket.room).emit('message', socket.username, 'entered this room');
            io.sockets.in(socket.room).emit('updateusers', socket.room, users);
            io.sockets.in(oldroom).emit('updateusers', oldroom, users);
            io.sockets.in(socket.room).emit('updateinfo',socket.room);
            io.sockets.in(oldroom).emit('updateinfo',oldroom);
        } else {
            console.log("You are banned by the admin or your password is wrong");
        }

    });

    socket.on('kick', function(user_kick, user_owner) {
        if (user_owner == owners[socket.room]) {
            io.sockets.in(socket.room).emit('kickOut', user_kick);
            users[user_kick] = 'mainroom';
        } else {
            sconsole.log("need to implement");
        }
    });

    socket.on('ban', function(user_ban, user_owner) {
        if (user_owner == owners[socket.room]) {
            io.sockets.in(socket.room).emit('banOut', user_ban, socket.room);
            users[user_ban] = 'mainroom';
        } else {
            console.log("need to implement");
        }

    });

    socket.on('privateMsg', function(receriver, sender, msg) {
        if (users[receriver] == socket.room) {
            //socket.broadcast.to(socket.room).emit('private_mess1', receriver, sender, msg);
            io.sockets.in(socket.room).emit('private_mess1',receriver,sender,msg);
        }

    });

    socket.on('check_admin',function(username){
      //socket.broadcast.to(socket.room).emit('updateadmin',socket.room,owners);
      if(users[username]==socket.room){
        io.sockets.in(socket.room).emit('updateadmin',socket.room,owners);

      }
    });

});
