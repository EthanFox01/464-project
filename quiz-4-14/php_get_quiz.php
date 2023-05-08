<?php
session_start();
?>
<html>

<head>
	<title>PHP Message Counter</title>
</head>

<body>
	<div>
		<form method="get">
			<label for="message">Enter a message: </label>
			<input type="text" id="message" name="message"><br>
		</form>
		<input type="submit" value="Submit" onclick="sendMessage()"><br>
		<p id="get_message_output">0</p>
	</div>
	<script>
		var request = null;
		function sendMessage() {
			var message = document.getElementById("message").value;
			var url = "counter.php?message=" + encodeURIComponent(message);
			request = new XMLHttpRequest();
			request.open("GET", url, true);
			request.send(null);
		}

		function getMessage() {
			request = new XMLHttpRequest();
			var url = "counter.php";
			request.open("GET", url, true);
			request.onreadystatechange = updatePage;
			request.send(null);
		}

		function updatePage() {
			if (request.readyState == 4) {
				var messageCount = document.getElementById("get_message_output");
				var response = request.responseText.split(":");
				if (Number(response[0]) > Number(messageCount.innerHTML)) {
					console.log("bad");
					messageCount.innerHTML = response[0];
					last_message = document.createElement("p");
					last_message.innerHTML = response[1];
					document.body.append(last_message);
				}
			}
		}

		setInterval('getMessage()', 100);
	</script>
</body>

</html>