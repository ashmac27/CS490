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
	<title>Return to Create Question</title>
</head>
<?php
	$topic = urlencode($_POST["topic"]);
	$difficulty = $_POST["difficulty"];
	$question =urlencode($_POST["question"]);
	$testCase1 =urlencode($_POST["testCase1"]);
	$answer1 =urlencode($_POST["answer1"]);
	$testCase2 =urlencode($_POST["testCase2"]);
	$answer2 =urlencode($_POST["answer2"]);
	$testCase3 =urlencode($_POST["testCase3"]);
	$answer3 =urlencode($_POST["answer3"]);
	$testCase4 =urlencode($_POST["testCase4"]);
	$answer4 =urlencode($_POST["answer4"]);
	$forConstraint= $_POST["forloop"];
	$printConstraint = $_POST["print"];




	$postRequest=array(
	'topic' =>$topic,
	'difficulty' =>$difficulty,
	'question' =>$question,
	'testCase1' => $testCase1,
	'answer1' => $answer1,
	'testCase2' => $testCase2,
	'answer2' => $answer2,
	'testCase3' => $testCase3,
	'answer3' => $answer3,
	'testCase4' => $testCase4,
	'answer4' => $answer4,
	'forloop' => $forConstraint,
	'print' => $printConstraint);
	
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/aq.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	//$apiresponse=trim($apiresponse);
	//$apiresponse=utf8_encode($apiresponse);
	//$json_response=json_decode($apiresponse);
	echo $apiresponse;
?><br><br>
<button onclick="goBack()">Return to Create a Question</button>
		<script>
			function goBack(){
				window.history.back();
			}
		</script>

<body>

</body>
</html>