<?php
//For teacher only

//Ashley Macote, CS490, Backend
$host = "sql1.njit.edu";
$user = "am2829";
$dbpassword = "urLNjFMv";
$db  = "am2829";
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);




$exam = $_POST['exam'];
$stu_username = $_POST['student'];
$comments = unserialize($_POST['comments']);
$student_answers = unserialize($_POST['studentanswers']);
foreach($comments as $value){
    $update_grades = "UPDATE Grades
                         SET grade = '$grade', comments = '$value', student_answers = '$student_answers[$i]'
                        WHERE username = '$stu_username'";
    $i = $i+1;
}

$db_conn->close();


?>
