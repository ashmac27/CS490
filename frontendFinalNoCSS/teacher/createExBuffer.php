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
	<title>Return to Create Exam</title>
</head>

<body>
	<?php
		$examName = $_POST["examName"];
		$questions = $_POST["questionBank"];
		$points = array_merge(array_filter($_POST["points"]));
		//$qid = array_merge(array_filter($_POST["qid"]));
		$qid1 = $_POST["qid1"];
		$qB2=$_POST["qB2"];
		$qidtoSend=array();
		foreach ($questions as $question) {
			$count=0;
			foreach($qB2 as $qB){
				if($question==$qB){
					array_push($qidtoSend, $qid1[$count]);
				}
				$count++;
			}
		}
		//var_dump($qidtoSend);
		//var_dump($questions);
		//var_dump($qid);
		//var_dump($points);
		//print_r($points);
		//echo "<br>";
		//print_r($questions);
		////echo "<br>";
		//foreach($qid as $ques){
		//	echo $ques . "<br>";
		//}
		//foreach($points as $point){
		//	echo $point ."<br>";
		//}
	
		//echo $points;
		
		$postRequest=array(
			'examName'=> $examName,
			'questionBank' => serialize($questions),
			'points' => serialize($points),
			'qid' => serialize($qidtoSend)
		);
		$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/examset.php');
		curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
		curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
		$apiresponse=curl_exec($Curl);
		curl_close($Curl);
		$apiresponse=trim($apiresponse);
		
		echo $apiresponse;
	?>
	<br>
	<button onclick="goBack()">Back to Create an Exam Page.</button>
	<script>
		function goBack(){
			window.history.back();
		}
	</script>
</body>
</html>