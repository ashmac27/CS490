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
		white-space: pre;
	}
</style>

<head>
	<title>Return to Student Home Page.</title>
</head>
<body>
	<?php
	$examName = $_POST["examName"];
	$studentAnswers = $_POST["studentAnswers"];
	$qid = $_POST["qid"];
	//foreach($qid as $id){
	//	echo $id;
	//}
	$username = $_POST['username'];
	$postRequest=array(
			'examName'=> $examName,
			'userName'=> $username,
			'qid' => serialize($qid),
			'studentAnswers' => serialize($studentAnswers));

	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/stexam.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	//echo $examName ."<br>";
	var_dump($apiresponse);
	//foreach($studentAnswers as $Answer){
	//	echo $Answer ."<br>";
	//}
	//echo $username."<br>";
	//var_dump($apiresponse);
	?><br><br>
<button style="font-size:20pt;" onclick="goBack()">Return to Student Home Page.</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/student/student.php');
		}
	</script>
</body>
</html>