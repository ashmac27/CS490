<?php
	session_start();
?>
<html>
<body>

<?php
	$user = $_POST["username"];
	$pass = $_POST["password"];

	$postRequest=array(
	'username' =>$user,
	'password' =>$pass);

	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/proj.php');
	curl_setopt($Curl,CURLOPT_POSTFIELDS,$postRequest);
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse);
	//var_dump($json_response);
	$_SESSION["username"]=$json_response->username;
	$_SESSION["role"]=$json_response->role;
	
	
?>

<script type="text/JavaScript">
	var stat = '<?php echo $json_response->status;?>';
	var user = '<?php echo $json_response->username;?>';
	var role = '<?php echo $json_response->role;?>';
	
	
	if(stat=="verified" && role=="Teacher"){
		window.location.replace('https://web.njit.edu/~rna25/teacher/teacher.php');
	}
	else if(stat=="verified" && role=="Student"){
		window.location.replace('https://web.njit.edu/~rna25/student/student.php');
	}
	else if(stat=="unverified"){
		window.location.replace('https://web.njit.edu/~rna25/invalid.php');
	}
</script>



</body>
</html>
