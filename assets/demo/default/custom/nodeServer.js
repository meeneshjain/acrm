var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );
var mysql = require('mysql');  
var slashes = require('slashes');
var con = mysql.createConnection({  
	host: "localhost",  
	user: "root",  
	password: "",  
	database: "mycrm"  
});  

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

io.sockets.on( 'connection', function( client ) {
	console.log( "New client" );
	client.on( 'notification', function( data ) {
		//console.log( 'Notification received ' + data.notification);
		//console.log( data.notification + ' ' + data.serverData);
		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		console.log(data.notification.user);
		io.sockets.emit( 'notification', { notification: data.notification, serverData: data.serverData } );
	});
});

io.sockets.on('connection', function (socket) {
  socket.on('join', function (data) {
    socket.join(data.socket_id); // We are using room of socket io
    console.log(data.socket_id);
  });
});


/*io.sockets.on('connection', function (client) {
	client.on( 'userlist', function( data ) {
		var sql = "SELECT id,CONCAT(name,' ',lname,' (',username,')') as ename,is_login FROM employee WHERE `is_delete` = '0' AND `status` = '1' AND `is_login` = '1'";
		con.query(sql, function (err, result) {
	    if (err) throw err;
	    	//console.log(result);
	    	io.sockets.emit( 'userlist',{socket_id:data.socket_id,userlist:result});
	  	});
	});
});*/

io.sockets.on('connection', function (client) {
	client.on( 'new_msg', function( data ) {
		var sql = "INSERT INTO `chat_history` (`from_id`, `to_id`, `messege`, `send_at`) VALUES ('"+data.chatmsg.to_id+"', '"+data.chatmsg.from_id+"', '"+slashes.add(data.chatmsg.messege)+"', '"+data.chatmsg.db_date+"')";
		con.query(sql, function (err, result) {
	    if (err) throw err;
	    	console.log("1 record inserted");
	  	});
		io.sockets.in('socket_'+data.chatmsg.from_id).emit('new_msg', {chatmsg:data.chatmsg});
	});
});




io.sockets.on('connection', function (client) {
	client.on( 'isTyping', function( data ) {
		io.sockets.in('socket_'+data.id).emit('isTyping', {id:data.id});
	});
});

io.sockets.on( 'connection', function( client ) {
	client.on( 'chatmsg', function( data ) {
		//console.log(data.chatmsg);
		//console.log('Insert Here');
		//console.log(data.chatmsg.db_date);
		/*var sql = "INSERT INTO `chat_history` (`from_id`, `to_id`, `messege`, `send_at`) VALUES ('"+data.chatmsg.to_id+"', '"+data.chatmsg.from_id+"', '"+slashes.add(data.chatmsg.messege)+"', '"+data.chatmsg.db_date+"')";
		con.query(sql, function (err, result) {
	    if (err) throw err;
	    	console.log("1 record inserted");
	  	});
		io.sockets.emit( 'chatmsg', { chatmsg: data.chatmsg, serverData: data.serverData } );*/
	});
});

io.sockets.on('connection', function (client) {
	client.on( 'meeting_notify_to_user', function( data ) {
		io.sockets.in('socket_'+data.id).emit('meeting_notify_to_user', {id:data.id,msg:data.msg});
	});
});

server.listen( 8080 );
