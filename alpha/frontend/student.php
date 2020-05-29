<?php
	session_start();
?>
<html>
	<body>
	Hello Student User:<?php echo $_SESSION['username'];?><br>
	<button onclick="goBack()">Return to login screen</button>
	<script>
		function goBack(){
			window.history.back();
		}
	</script>
	</body>
</html>
