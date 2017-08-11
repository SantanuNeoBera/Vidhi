var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();


var RedisClient = Redis.createClient();

redis.subscribe('userLoggedInChannel');
redis.subscribe('PrivateMessageChannel');

redis.on('message',function(channel, message){
	if (channel == "PrivateMessageChannel") {
		message = JSON.parse(message);
		console.log('New Message : ' + message.data.message);
		console.log('Socket Id : '+message.data.socketId);
		console.log('Sender Id : ' + message.data.senderId);
		console.log('Sent Time :' + message.data.sentTime);
		console.log('Sender Name :' + message.data.senderName);
		console.log(message.event);
		io.to(message.data.socketId).emit('GetAMessage', message.data);
	}
	else{
		console.log('Channel : ' + channel);
		console.log('Message : ' + message);
	}	
});

server.listen(3000, function(){
	console.log('Server Has Started !'); //Printing to the console when the server starts
}); //listening to port 3000

io.on('connection',function(socket){
	socket.on('userConnected',function(data){
		console.log( 'User ID : ' + data.userId + " Connected ");
		RedisClient.set(data.userId,data.socketId);
		console.log('Socket ID : ' + RedisClient.get(data.userId));
	});
	socket.on('disconnect',function(){
		console.log('User disconnect');
	})
});