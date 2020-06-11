<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<style type="text/css">
	body{
		background-image:url('images/whiteblue.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
	div{
		white-space: pre;
	}
	label,p{
		font-size: 16pt;
		border: 1px solid black;
	}
	textarea{
		font-size: 16pt;
	}
</style>
<head>
	<meta charset="utf-8">
	<title>Take Exam</title>
</head>
<?php
	$postRequest=array('userName'=>$_SESSION['username']);
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/getExamQuestions.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);

	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=ltrim($apiresponse, "TestingArray");
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$questions=$json_response;
	//var_dump($json_response);
	//echo $questions[0]['exam'];
	
?>
<h2 style="text-align: left;">Good Luck on your exam, <?php echo $_SESSION['username'];?></h2>

<body>
	<div >
	<form style="text-aligns:left;" action="https://web.njit.edu/~rna25/student/takeExamBuffer.php" method="post">
		<fieldset>
		<legend><?php echo $questions[0]['exam'];?>:</legend>
		<?php
			$count=1;
			foreach($questions as $question){
				echo
				'
				<p>Question '.$count.':</p>
				<'.$question["points"].' points> 
				<label for="'.$count.'"> "'.$question["question"].'" </label><br> 
				<textarea  rows="20" cols="100" name="studentAnswers[]" id="'.$count.'"></textarea><br>
				<input type="hidden" id="qid" name="qid[]" value="'.$question["qid"].'"><br>
				';
				$count=$count+1;
			}
		?>
		</fieldset>
		<input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
		<input type="hidden" name="examName" value="<?php echo $questions[0]['exam'];?>">
		<input type="submit" value="Submit Exam to Professor.">
	</form>
</div>
	<button style="font-size:20pt;" onclick="goBack()">Return to Student Home Page.</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/student/student.php');
		}
	</script>

</body>


</html>