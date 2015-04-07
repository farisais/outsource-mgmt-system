var express = require('express');
var app = express();
var util = require('util');
var mysql = require('mysql');
var needle = require('needle');
var rest = require('restler');
var connection = mysql.createConnection({
	host: '127.0.0.1',
	user: 'root',
	password: '',
	database: 'hanan_db'
});

//connect database
connection.connect(function(err){
	if(!err)
	{
		console.log('Database connected..');
	}
	else
	{
		console.log('Error connecting database..');
		console.log(err.toString());
	}
});

app.use(function(req, res, next) {
        res.header("Access-Control-Allow-Origin", "*");
        res.header("Access-Control-Allow-Headers", "X-Requested-With");
        res.header("Access-Control-Allow-Headers", "Content-Type");
        res.header("Access-Control-Allow-Methods", "PUT, GET, POST, DELETE, OPTIONS");
        next();
    });

app.get('/get_fdevice_assign/:param', function(req, res){
	
	var query = 'select fad.*, fd.serial_number from fingerprint_assign_detail as fad inner join fingerprint_device as fd on fd.id_fingerprint_device=fad.fingerprint_device';
	connection.query(query, function(err, rows, fields) {
		if (err) throw err;
		
		res.send(rows);
		console.log('The solution is: ', rows);
		io.sockets.emit('time', { time: rows } );
	});
		
	
});

app.get('/get_device_transaction/:param', function(req, res){
	var query = 'select fa.app_id, fad.*, fd.serial_number from fingerprint_assign_detail as fad inner join fingerprint_device as fd on fd.id_fingerprint_device=fad.fingerprint_device inner join fingerprint_assign as fa on fa.id_fingerprint_assign=fad.fingerprint_assign';
	connection.query(query, function(err, rows, fields) {
		if (err) throw err;
		
		//res.send(rows);
		var i=0;
		for(i=0;i<parseInt(rows.length);i++)
		{
			console.log(rows.length);
			var AppID = rows[i]['app_id'];
			console.log(AppID);
			var sock = getSocketByAppID(AppID);
			if(sock!=null)
			{
				console.log(sock.id);
				console.log('Send command request_transaction_today to APPID[' + AppID + ']');
				//io.sockets.emit('time', { time: 'Send command request_transaction_today to APPID[' + AppID + ']' } );
				sock.emit('request_transaction', { date: new Date().toJSON() });
			}
		}
		res.send("transaction success");
		//console.log('The solution is: ', rows);
		//io.sockets.emit('time', { time: rows } );
		
	});
});

app.get('/get_timesheet_all/:param', function(req,res){

});
	
var http = require('http');
    //fs = require('fs'),
    // NEVER use a Sync function except at start-up!
    //index = fs.readFileSync(__dirname + '/index.html');

// Send index.html to all requests
//var app = http.createServer(function(req, res) {
//    res.writeHead(200, {'Content-Type': 'text/html'});
//    res.end(index);
//});

var server = http.createServer(app);

// Socket.io server listens to our app
var io = require('socket.io').listen(server, { origins: '*:*' });
var clients = [];
var commands = [];

// Send current time to all connected clients
function sendTime() {
	
	console.log('this is clients array : ' + util.inspect(clients));
	//console.log('this is commands array : ' + util.inspect(commands));
    io.sockets.emit('time', { time: new Date().toJSON() } );
}

// Send current time every 10 secs
setInterval(sendTime, 10000);

// Emit welcome message on connection
io.sockets.on('connection', function(socket) {
    var client = {};
	client['socket'] = socket;
	clients.push(client);
	
	socket.emit('welcome', { message: 'Welcome to Fingerprint Device Sync Server!' });
	
	socket.on('regAppID', function(data){
		//cek apakah appid yg sama ada pada array clients, jika ada maka delete yang lama
		var indexAppID = getClientIndexByAppID(data.AppID);
		if(indexAppID >= 0)
		{
			clients.splice(indexAppID, 1);
            console.log('Same AppID found, removing the old one');
		}
		
		console.log('Registering AppID : ' + data.AppID); 
		var index = getClientIndexBySocketID(socket.id);
		if(index >= 0)
		{
			clients[index]['AppID'] = data.AppID;
			clients[index].socket.emit('dMessage', { message: 'Application ID : ' + data.AppID + ' has been successfully registered with socket ID : ' + socket.id});
		}
	});
	
	//ON SOCKET DISCONEECT
	socket.on('disconnect', function(){
		var index = getClientIndexBySocketID(socket.id);
		if(index >= 0)
		{
			clients.splice(index, 1);
            console.log('Client gone (id=' + socket.id + ').');
		}
	});
	
	//ON SOCKET ERROR
	socket.on('error', function(){
		var index = getClientIndexBySocketID(socket.id);
		if(index >= 0)
		{
			clients.splice(index, 1);
            console.log('Client gone (id=' + socket.id + ').');
		}
	});
	
    socket.on('receiveBroadcast', function(data){
		var index = getClientIndexBySocketID(socket.id);
		if(index >= 0)
		{
			console.log('Receive Broadcast from APPID[' + clients[index]['AppID'] + ']');
			console.log('message : ' + data.message);
			
			io.sockets.emit('sendBroadcast', { message : data.message });
		}
		
	});

    socket.on('rte', function(data){
		socket.emit('listenRte', { eventName: data.eventName, eventArgs: data.eventArgs, AppID: data.AppID });
		var index = getClientIndexBySocketID(socket.id);
		if(index >= 0)
		{
            console.log('AppID['+ clients[index].AppID +'] sending an RTEvent');
			data['AppID'] = clients[index].AppID;
		}
		console.log(data.eventName);
		for(i=0;i<data.eventArgs.length;i++)
		{
			for(var key in data.eventArgs[i])
			{
				console.log(key + " => " + data.eventArgs[i][key]);
			}
		}
		
		//getSocketByAppID(data.AppID).emit('listenRte', { eventName: data.eventName, eventArgs: data.eventArgs, AppID: data.AppID });
		io.sockets.emit('listenRte', { eventName: data.eventName, eventArgs: data.eventArgs, AppID: data.AppID });
		
	});
	
	socket.on('fdCommand', function(data){
		var command = { appID: data.appID, devID: data.devID, socket_master: socket.id, commandID: data.commandID ,command: data.command, parameter: data.parameter };
		console.log(JSON.stringify(command));
		var sock = getSocketByAppID(data.appID);
		if(sock != null)
		{
			addCommandList(data, socket);
			sock.emit('fdCommand', command);
		}
		else
		{
			socket.emit('fdCommandRespons', {AppID: data.appID, commandID: data.commandID, command: data.command,respons: { status: 'failed', message: 'Unable to connect to Fingersync Daemon ['+ data.appID +']'}} );
		}
	});
	
	socket.on('fdCommandRespons', function(data){
		console.log(data.commandID);
		console.log(data.respons);
		var masterSock = getMasterSocketCommand(data.commandID);
		switch(data.command)
		{
			case 'enroll_fingerprint':
                //changeCommandStatus(data.commandID, 'respon_sent');
				console.log('This is enroll_fingerprint command, treat differently');
				if(masterSock != null)
				{
					masterSock.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: data.command,respons: data.respons});
				}
				else
				{
					console.log('Unable to get master socket');
				}
                
                //Tidak perlu menghapus record command
			break;
            case 'register_user_bulk':
                changeCommandStatus(data.commandID, 'respon_sent');
    			if(masterSock != null)
    			{
    				masterSock.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: data.command,respons: data.respons});
    			}
    			else
    			{
    				console.log('Unable to get master socket');
    			}
    			var index = getCommandIndexByCommandID(data.commandID);
    			if(index >= 0)
    			{
    				commands.splice(index, 1);
    				console.log('Command remove from list (commandID=' + data.commandID + ').');
    			}
            break;
			default:
			//io.sockets.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, respons: data.respons});
			changeCommandStatus(data.commandID, 'respon_sent');
			if(masterSock != null)
			{
				masterSock.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: data.command,respons: data.respons});
			}
			else
			{
				console.log('Unable to get master socket');
			}
			var index = getCommandIndexByCommandID(data.commandID);
			if(index >= 0)
			{
				commands.splice(index, 1);
				console.log('Command remove from list (commandID=' + data.commandID + ').');
			}
			break;
		}
	});
	
	socket.on('fdCommandInProcMessage', function(data){
		console.log(JSON.stringify(data));
		var masterSock = getMasterSocketCommand(data.commandID);
		if(masterSock != null)
		{
			masterSock.emit('fdCommandInProcMaster', data);
		}
		else
		{
			console.log('Unable to get master socket');
		}
	});
	
	socket.on('appCommand', function(data){
		console.log(JSON.stringify(data));
		switch(data.command)
		{
			case 'updateStatusDevice':
				connection.query()
			break;
			case 'att_transaction':
				var data_post = {};
				data_post['data'] = data;
				rest.post('http://127.0.0.1/bazcorp/timesheet/entry_timesheet_data', data_post).on('complete', function(data, response){
					console.log(data);
				});
			break;
			case 'request_transaction':
				var data_post = {};
				data_post['data'] = data;
				rest.post('http://127.0.0.1/bazcorp/timesheet/entry_timesheet_fingeprint_log', data_post).on('complete', function(data, response){
					console.log(data);
				});
				//io.sockets.emit('listenRte', { eventName: 'request_transaction', eventArgs: data.data, AppID: null } );
			break;
			case 'enroll_complete':
				var masterSock = getMasterSocketCommand(data.commandID);
				if(data.status == 'success')
				{
					if(masterSock != null)
					{
						masterSock.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: 'enroll_complete',respons: data});
						/*var id_employee = '';
						connection.query('select id_employee from employee where employee_number = ' + data.employee_number, function(err, rows){
							if(err) throw err;
							id_employee = rows[0].id_employee;
							connection.query('delete from fingerprint_template where employee = ' + id_employee, function(err2, rows2){
								if(err2) throw err2;
								connection.query("insert into fingerprint_template (employee,fingerprint_tmp,fid,flag,tmp_length) VALUES (" + id_employee + "," + data.fingerprint_tmp + "," + data.fid + "," + data.flag + "," + data.tmp_length + ")", function(err3, rows3){
									if(err3) throw err3;
									getMasterSocketCommand(data.commandID).emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: 'enroll_complete',respons: 'fingerprint data for user ' + data.full_name + ' has successfully saved into database'});
								});
							});
						});*/
					}
					else
					{
						console.log('Unable to get master socket');
					}
				}
				else
				{
					if(masterSock != null)
					{
						masterSock.emit('fdCommandRespons', {AppID: data.AppID, commandID: data.commandID, command: 'enroll_complete',respons: data});
					}
					else
					{
						console.log('Unable to get master socket');
					}
				}
				changeCommandStatus(data.commandID, 'respon_sent');
				//Clear command array
				var index = getCommandIndexByCommandID(data.commandID);
				if(index >= 0)
				{
					commands.splice(index, 1);
					console.log('Command remove from list (commandID=' + data.commandID + ').');
				}
			break;
		}
	});
});

function InsertFPTemplate(data)
{
	
	
}

function addCommandList(data, socket)
{
	var command = {};
	command['AppID'] = data.appID;
	command['commandID'] = data.commandID;
	command['socket_master'] = socket;
	command['command'] = data.command;
	command['status'] = 'wait_respon';
	
	commands.push(command);
}

function getMasterSocketCommand(commandID)
{
	for(i=0;i<commands.length;i++)
	{
		if(commands[i]['commandID'] == commandID)
		{
			return commands[i]['socket_master'];
		}
	}
	
	return -1;
}
function changeCommandStatus(commandID, status)
{
	for(i=0;i<commands.length;i++)
	{
		if(commands[i]['commandID'] == commandID)
		{
			commands[i]['status'] = status;
		}
	}
}

function getCommandIndexByCommandID(commandID)
{
	for(i=0;i<commands.length;i++)
	{
		if(commands[i]['commandID'] == commandID)
		{
			return i;
		}
	}
	return -1;
}
function getClientIndexBySocketID(socketID)
{
	for(i=0;i<clients.length;i++)
	{
		if(clients[i]['socket'].id == socketID)
		{
			return i;
		}
	}
	
	return -1;
}

function getClientIndexByAppID(AppID)
{
	for(i=0;i<clients.length;i++)
	{
		if(clients[i]['AppID'] == AppID)
		{
			return i;
		}
	}
	
	return -1;
}

function getSocketByAppID(AppID)
{
	for(i=0;i<clients.length;i++)
	{
		if(clients[i]['AppID'] == AppID)
		{
			return clients[i].socket;
		}
	}
	
	return null;
}

server.listen(3000);
