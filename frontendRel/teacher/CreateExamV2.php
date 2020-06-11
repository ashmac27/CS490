<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<style type="text/css">
	body{
		background-image:url('images/redwhite.png');
		background-repeat: no-repeat;
		background-size: cover;
		height:100%;
	}
	html{
		height: 100%;
	}
</style>
<head>
	<title>Create an Exam</title>
</head>
<body>
	<iframe scrolling="yes" src="https://web.njit.edu/~rna25/teacher/showExam.php" style="overflow:hidden; height:100%; width: 49%; float: left;" width="49%" height="100%"></iframe>

	
	<iframe scrolling="yes" src="https://web.njit.edu/~rna25/teacher/createExam.php" style="overflow:hidden; height:100%; width: 49%; float: right;" width="49%" height="100%"></iframe>

</body>
</html>