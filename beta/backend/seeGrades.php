<?php

//for student only and teacher

//Ashley Macote, CS490, Backend
$host = "sql1.njit.edu";
$user = "am2829";
$dbpassword = "urLNjFMv";
$db  = "am2829";
//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);



//the student's username 
$username = $_POST['username'];

$see_grades = "SELECT username, exam, grade, comments FROM StudentAnswers WHERE username = '$username'";
$sg_query = $db_conn->query($see_grades);
$row = $sg_query->fetch_assoc();
$grade = $row['grade'];
$exam = $row['exam'];
$comments = $row['comments'];

if($sg_query-> num_rows == 1){
    $my_obj->username = "$username";
    $my_obj->exam = "$exam";
    $my_obj->grade = "$grade";
    $my_obj->comments = "$comments";
}

//encoding json response
echo json_encode($my_obj); 
$db_conn->close();
?>
