<?php
//For teacher only

//Ashley Macote, CS490, Backend
$host = "sql1.njit.edu";
$user = "am2829";
$dbpassword = "urLNjFMv";
$db  = "am2829";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);


//Students clicks button with id exam to take it
//$exam = $_POST['exam'];
//if (isset($_POST['exam'])){
  //  $student_answers = "INSERT INTO StudentAnswers (exam, username, answer, total, comments)
    //               VALUES ('$exam','null','null', 'null', 'null')";
//}

$db_conn->close();


?>
