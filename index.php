<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>	



<script src="jquery-3.1.1.js"></script>


<script language="javascript" type="text/javascript">
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/demo/server.php";
	websocket = new WebSocket(wsUri);

	websocket.onopen = function(ev) { // connection is open
		console.log("connection started");
	}

	$('#send-btn').click(function(){ //use clicks message send button
		var msg = {
				type: 		"chat",
				message: 	"message",
				name: 		"name",
				color : 	"color"
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		console.log('send: '+msg);
	});

	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var uname = msg.name; //user name
		var ucolor = msg.color; //color

		console.log('Received: '+ev.data);
	};

	websocket.onerror	= function(ev){
		console.log("Error Occurred - "+ev.data);
	};
	websocket.onclose 	= function(ev){
		console.log("Connection Closed");
	};
});




</script>


<button id="send-btn" class=button>Send</button>

</body>
</html>