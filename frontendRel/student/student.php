<?php
	session_start();
?>
<html>
<style type="text/css">
	body{
		background-image:url('images/whiteblue.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
	<body>
	Hello Student User:<?php echo $_SESSION['username'];?><br>
	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/student/takeExam.php">Take Exam</a></p><br><br>
	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/student/reviewGradeS.php">Review an Exam</a></p><br><br>
	<div style="text-align:center;">
	<button style="font-size:20pt;" onclick="goBack()">Return to login screen</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/');
		}
	</script>
	</div>
	</body>
</html>
