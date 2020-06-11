<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<style type="text/css">
		table, th, td {
		  		border: 1px solid black;
		  		font-size: 14pt;
			}
	</style>
<head>
	<title>Show Current Exam</title>
</head>
<?php
	$userName= "am123";
	$postRequest=array('userName'=>$userName);
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
	//var_dump($apiresponse);
	echo $questions[0]['exam'];
	?>
	<body>

	<table>
		<?php
		$count=1;
		foreach($questions as $question){
			echo
				'<tr>
					<th>Question '.$count.':</th>
				</tr>
				<tr>
					<td><'.$question["points"].' points> <label for="'.$count.'"> "'.$question["question"].'" </label></td>
				</tr> 
				
				';
			$count=$count+1;
		}
		
		?>
	</table>

</body>
</html>