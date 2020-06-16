<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<style type="text/css">
		body{
			background-color:#F2F6F8;
		}
		
		label,p{
			font-size: 16pt;
			color: #071D49;
			
		}
		h2{
			font-size: 24pt;
			color: #071D49;
			font-weight: bold;
		}
		textarea{
			font-size: 16pt;
			border:1px solid black;
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
	

	<body>
		<div >
			<form style="text-aligns:left;" action="https://web.njit.edu/~rna25/student/takeExamBuffer.php" method="post">
				<fieldset>
					<h2 style="text-align: center;">Good Luck on your exam, <?php echo $_SESSION['username'];?></h2>
				<legend style="color: #071D49; font-size: 20pt; font-weight: bold;""><?php echo $questions[0]['exam'];?>:</legend>
				<?php
					$count=1;
					foreach($questions as $question){
						echo
						'
						<label>Question '.$count.':</label><br>
						('.$question["points"].' points) <label for="'.$count.'"> "'.urldecode($question["question"]).'" </label><br> 
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