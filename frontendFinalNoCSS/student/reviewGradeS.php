<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<style type="text/css">
	body{
		
		background-color: #F2F6F8;
		
		background-size: cover;
		margin:0px;
		height: 100%;
	}
	table{
		border: 1px solid black;
		border-collapse: collapse;
	}
	table, th, td {

  		font-size:18pt;
	}
	div{
		white-space: pre-wrap;
		border: 1px solid black;
		font-size:18pt;
	}
	p{
		white-space: pre-wrap;
		border: 1px solid black;
		font-size:18pt;
	}

		td{
		background-color: white;
		color:#071D49;
		border-top: 1px solid #D22630;
		
	}
</style>
<head>
	<title>Review Exam Grade</title>
</head>

<body>
	<?php
	$userName=$_SESSION["username"];
	$postRequest=array('ucid'=>$userName);
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/profcall.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$examResults=$json_response;
	//var_dump($json_response);
	//echo $examResults[0]["student_answers"];
	
	$postRequest=array('userName'=> $userName);
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/getGradedQuestions.php');
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
	echo $questions[0]['exam'];
	echo '<br>';
	
	
	$count=1;
	$count2=0;
	foreach($examResults as $result){
		$deduc=explode(";",$result["deduction"]);
		$teachdeduc=explode(",",$result["teachergrade"]);
		$total=$questions[$count2]["points"]+$deduc[0]+$deduc[1]+$deduc[2]+$deduc[3]+$deduc[4]+$deduc[5]+$deduc[6]+$deduc[7];
		$tTotal=$questions[$count2]["points"]+$teachdeduc[0]+$teachdeduc[1]+$teachdeduc[2]+$teachdeduc[3]+$teachdeduc[4]+$teachdeduc[5]+$teachdeduc[6]+$teachdeduc[7];
		if($total<0){
			$total=0;
		}
		if($tTotal<0){
			$tTotal=0;
		}
		echo 
			'
			Question '.$count.': '.$questions[$count2]["points"].' points<br>
			<div>'.urldecode($questions[$count2]["question"]).'</div><br>
			Student\'s Answer: <br>
			<div>'.urldecode($result["student_answers"]).'</div><br>
			<table>
				<tr style="background-color: #071D49; color: white;">
					<th>Name</th>
					<th>AutoGrade</th>
					<th>Teacher Grade</th>
				</tr>
						<tr>
							<td>Function Name</td>
							<td>'.$deduc[0].'</td>
							<td>'.$teachdeduc[0].'</td>
						</tr>
						<tr>
							<td>Test Case 1</td>
							<td>'.$deduc[4].'</td>
							<td>'.$teachdeduc[4].'</td>
						</tr>
						<tr>
							<td>Test Case 2</td>
							<td>'.$deduc[5].'</td>
							<td>'.$teachdeduc[5].'</td>
						</tr>
						<tr>
							<td>Test Case 3</td>
							<td>'.$deduc[6].'</td>
							<td>'.$teachdeduc[6].'</td>
						</tr>
						<tr>
							<td>Test Case 4</td>
							<td>'.$deduc[7].'</td>
							<td>'.$teachdeduc[7].'</td>
						</tr>
						<tr>
							<td>Colon Score:</td>
							<td>'.$deduc[3].'</td>
							<td>'.$teachdeduc[3].'</td>
						</tr>
						<tr>
							<td>Print Constraint</td>
							<td>'.$deduc[1].'</td>
							<td>'.$teachdeduc[1].'</td>
						</tr>
						<tr>
							<td>For Constraint</td>
							<td>'.$deduc[2].'</td>
							<td>'.$teachdeduc[2].'</td>
						</tr>
						<tr>
							<td>Total</td>
							<td>'.$total.'</td>
							<td>'.$tTotal.'</td>
						</tr>
			</table>
			Comments: <br>
			<p>'.$result["comments"].'</p>
			';
			$count=$count+1;
			$count2=$count2+1;
		}
			?>
	<button style="font-size:20pt;" onclick="goBack()">Return to Student Home Page.</button>
	<script>
		function goBack(){
			window.location.replace('https://web.njit.edu/~rna25/student/student.php');
		}
	</script>

</body>
</html>