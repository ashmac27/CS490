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
	<title>Send Review</title>
</head>
<body>
	<?php
		$userName=$_POST["username"];
		$corrections=$_POST["corrections"];
		$comments=$_POST["comments"];
		
		$corrections2=array();

		$quesNum=count($corrections)/8;
		$array = array();
		//for($count=0; $count<$quesNum; $count++)
		//{
			//for($count2=$count*8; $count<count($corrections); $count2++){
				//array_push($array, $count2);
			//}
			//array_push($corrections2,$array);
			//$array = array();
		//}
		//print_r($corrections2);
		
		$qid =$_POST["qid"];
		$examName=$_POST['examName'];
		$postRequest=array(
		'userName'=>$userName,
		'corrections'=>serialize($corrections),
		'comments'=>serialize($comments),
		'qid' => serialize($qid),
		'examName' => $examName
		);
		$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/saveTeacherOverride.php');
		curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
		curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
		$apiresponse=curl_exec($Curl);
		curl_close($Curl);
		$apiresponse=trim($apiresponse);
		$apiresponse=utf8_encode($apiresponse);
		$json_response=json_decode($apiresponse,true);
		$examResults=$json_response;
		var_dump($apiresponse);
	?>
	<button style="font-size:20pt;" onclick="goBack()">Return to Teacher Home Page..</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/teacher/teacher.php');
		}
	</script>
</body>
</html>