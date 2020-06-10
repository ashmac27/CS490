<?php

$host = "";
$user = "";
$dbpassword = "";
$db  = "";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);


$exam = $_POST['exam_title'];
$questions_array = unserialize($_POST['questions']);
$points = unserialize($_POST['points']);


$query = "SELECT username FROM login WHERE role ='student';";
$result = $db_conn->query($query);

$students_selected = [];

while($row = $result->fetch_assoc()){
    array_push($students_selected, $row['username']);
}

$student_status = "ungraded";


foreach ($students_selected as $username) {
    $exam_roster_insert = "INSERT INTO ExamRoster(username, exam, status)
                            VALUES('$username','$exam','$student_status');";
    $erq = $db_conn->query($exam_roster_insert);
}

//abhinav's
$i = 0;
foreach($questions_array as $value){
    $add_exam = "INSERT INTO Exams(exam, questions, points)
                  VALUES ('$exam','$value','$points[$i]')";
    echo $add_exam;
    echo '<br>';
    $i = $i+1;
}

/*
$add_exam = "INSERT INTO Exams (exam, questions, points)
             VALUES ('$exam','$questions_array','$points')";
$aeq = $db_conn->query($add_exam);
if($aeq ==TRUE){
    echo json_encode("You created an exam");
}
*/

$db_conn->close();
?>
