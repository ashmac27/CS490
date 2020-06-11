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
	table, th, td {
  		border: 1px solid black;
  		font-size:18pt;
	}
	div{
		white-space: pre-wrap;
		border: 1px solid black;
		font-size:18pt;
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
	var_dump($json_response);
	//echo $examResults[0]["student_answers"];
	
	$postRequest=array('userName'=> $userName);
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
	echo $questions[0]['exam'];
	
	
	$count=1;
	$count2=0;
	foreach($examResults as $result){
		$deduc=explode(";",$result["deduction"]);
		$total=$questions[$count2]["points"]+$deduc[0]+$deduc[1]+$deduc[2]+$deduc[3]+$deduc[4]+$deduc[5]+$deduc[6]+$deduc[7];
		echo 
			'
			Question '.$count.': '.$questions[$count2]["points"].' points<br>
			<div>'.$questions[$count2]["question"].'</div><br>
			Student\'s Answer: <br>
			<div>'.$result["student_answers"].'</div><br>
			<table>
				<tr>
					<th>Name</th>
					<th>AutoGrade</th>
					<th>Teacher Grade</th>
				</tr>
						<tr>
							<td>Function Name</td>
							<td>'.$deduc[0].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Test Case 1</td>
							<td>'.$deduc[4].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Test Case 2</td>
							<td>'.$deduc[5].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Test Case 3</td>
							<td>'.$deduc[6].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Test Case 4</td>
							<td>'.$deduc[7].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Colon Score:</td>
							<td>'.$deduc[3].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Print Constraint</td>
							<td>'.$deduc[1].'</td>
							<td></td>
						</tr>
						<tr>
							<td>For Constraint</td>
							<td>'.$deduc[2].'</td>
							<td></td>
						</tr>
						<tr>
							<td>Total</td>
							<td>'.$total.'</td>
							<td></td>
						</tr>
			</table>
			Comments: <br>
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