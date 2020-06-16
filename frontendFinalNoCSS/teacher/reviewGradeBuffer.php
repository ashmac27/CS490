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
	div{
		white-space: pre-wrap;
		border: 1px solid black;
		font-size:18pt;
	}
	table, th, td {
  		border: 1px solid black;
  		font-size:18pt;
	}
	textarea{
		font-size:14pt;
	}
</style>
<head>
	<title>Review Student Exam Grades</title>
</head>
<body>
	<?php
	$userName=$_POST["username"];
	$postRequest=array('ucid'=>$userName);
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/profcall.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=ltrim($apiresponse, "array(3)");
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$examResults=$json_response;
	//var_dump($json_response);
	//echo $examResults[0];
	//echo $userName;
	$postRequest=array('userName'=> $userName);
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/getExamQuestions.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);

	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$questions=$json_response;
	$examName=$questions[0]['exam'];
	//var_dump($json_response);
	//echo $questions[0]['exam'];
	
	?>
	
	<form style="text-aligns:left;" action="https://web.njit.edu/~rna25/teacher/sendReview.php" method="post">
		<fieldset>
			<legend style="font-size:20pt; border: 1px solid black;";><?php echo $userName;?>'s Exam</legend>
			<input type="hidden" name="username" value="<?php echo $userName;?>">
			<input type="hidden" name="examName" value="<?php echo $examName;?>">
			<?php
			$count=1;
			$count2=0;
				foreach($examResults as $result){
					//$resultG= 20+$result["grade"];
					$deduc=explode(";",$result["deduction"]);
					
					//var_dump($deduc);
					//echo $result;
					$total=$questions[$count2]["points"]+$deduc[0]+$deduc[1]+$deduc[2]+$deduc[3]+$deduc[4]+$deduc[5]+$deduc[6]+$deduc[7];
					if($total<0){
						$total=0;
					}
					echo 
					'
					Question '.$count.': '.$questions[$count2]["points"].' points<br>
					<div>'.urldecode($questions[$count2]["question"]).'</div><br>
					Student\'s Answer: <br>
					<div>'.urldecode($result["student_answers"]).'</div><br>
					<table>
						<tr>
							<th>Name</th>
							<th>Autograde</th>
							<th>Review Score</th>
						</tr>
						<tr>
							<td>Function Name</td>
							<td>'.$deduc[0].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[0].'"> points</td>
						</tr>
						<tr>
							<td>Test Case 1</td>
							<td>'.$deduc[4].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[4].'"> points</td>
						</tr>
						<tr>
							<td>Test Case 2</td>
							<td>'.$deduc[5].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[5].'"> points</td>
						</tr>
						<tr>
							<td>Test Case 3</td>
							<td>'.$deduc[6].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[6].'"> points</td>
						</tr>
						<tr>
							<td>Test Case 4</td>
							<td>'.$deduc[7].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[7].'"> points</td>
						</tr>
						<tr>
							<td>Colon Score:</td>
							<td>'.$deduc[3].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[3].'"> points</td>
						</tr>
						<tr>
							<td>Print Constraint</td>
							<td>'.$deduc[1].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[1].'"> points</td>
						</tr>
						<tr>
							<td>For Constraint</td>
							<td>'.$deduc[2].'</td>
							<td><input type="number" id ="'.$count.'" name="corrections[]" value="'.$deduc[2].'"> points</td>
						</tr>
						<tr>
							<td>Total</td>
							<td>'.$total.'</td>
							<td></td>
						</tr>
					</table>
					Comment: <br>
					<textarea rows="6" cols="80" name="comments[]" ></textarea><br><br>
					<input type="hidden" name="qid[]" value="'.$questions[$count2]["qid"].'">
					
					';
					$count=$count+1;
					$count2=$count2+1;
				}
			?>
		</fieldset>
		<input type="submit" value="Submit Review">
	</form>
	
	<button onclick="goBack()">Back to Select a Student.</button>
	<script>
		function goBack(){
			window.history.back();
		}
	</script>
</body>
</html>