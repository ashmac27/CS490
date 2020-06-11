<?php
	session_start();
?>
<html>
<style type="text/css">
	body{
		background-image:url('images/redwhite.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
	<body>
	Hello Teacher User:<?php echo $_SESSION['username'];?><br><br>

	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/CreatQuestV2.php">Create a Question</a></p><br><br>
	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/CreateExamV2.php">Create an Exam</a></p><br><br>
	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/reviewGradeT.php">Review an Exam Grade</a></p><br><br>
	<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/something.php">Table</a></p><br><br>
	


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
