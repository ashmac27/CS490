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
	}
</style>

<head>
	<title>Select Student Username to Review Exam</title>
</head>
<h1>Review Grades of students</h1>
<?php
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/studentsList.php');
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=trim($apiresponse,"1");
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$userNames=$json_response;
	//var_dump($json_response);
	//echo $userNames[0]["username"];
	
?>
<body>
	<form style="text-align:left;" action="https://web.njit.edu/~rna25/teacher/reviewGradeBuffer.php" method="post">
		<fieldset>
			<legend>Select Student Username:</legend>
			<select id="username" name="username">
				<?php 
				foreach($userNames as $userName){
					echo
					'
					<option value="'.$userName["username"].'">"'.$userName["username"].'"</option>
					';
				}

				?>
			</select><br>
			<input type="submit" value="Get Student's Exam">
		</fieldset>

	</form>
	<button style="font-size:20pt;" onclick="goBack()">Return to Teacher Home Page..</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/teacher/teacher.php');
		}
	</script>
</body>
</html>