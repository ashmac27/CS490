<?php

//Ashley Macote, CS490, Backend
$host = "sql1.njit.edu";
$user = "am2829";
$dbpassword = "urLNjFMv";
$db  = "am2829";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);

$response = "fail";
$exam = $_POST['exam_title'];
//question bank should be an unordered list with the id question_bank
$questions_array = $_POST['questions'];
$points = $_POST['points'];

//foreach($i in $question_array_str)


$query = "SELECT username FROM login WHERE role ='student';";
$result = $db_conn->query($query);

$students_selected = [];

while($row = $result->fetch_assoc()){
    array_push($students_assigned, $row['username']);
}

$student_status = "ungraded";
//$exam_status = "undelivered";
foreach ($students_assigned as $username) {
    $exam_roster_insert = "INSERT INTO ExamRoster(username, exam, status)
                            VALUES('$username','$exam','$student_status');";
    $erq = $db_conn->query($exam_roster_insert);
}

//insert exam title, array of all the questions, array of all the points related 
//to questions, insert exam status (not yet delivered)
$add_exam = "INSERT INTO Exams (exam, questions, points)
             VALUES ('$exam','$questions_array','$points')";
$aeq = $db_conn->query($add_exam);
if($aeq ==TRUE){
    echo json_encode("You created an exam");
}

//if teacher decides to click to send the exam to students
//if($_POST['deliver_exam']){
  //  $deliver_exam_q = "UPDATE ExamRoster SET status = 'delivered' WHERE exam = '$exam'";
    //$deq = $db_conn->query($deliver_exam_q);
//}

//if($deq == TRUE){
  //  $response = "You sent the exam!";
   // echo json_encode($response);
//}

$db_conn->close();
?>

