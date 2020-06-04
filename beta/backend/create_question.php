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


$topic = $_POST['topic'];
$difficulty = $_POST['difficulty'];
$question = $_POST['question'];
$tc1 = $_POST['testcase1'];
$tc2 = $_POST['testcase2'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];

$question_query = "INSERT INTO Questions (topic, difficulty, question, tc1, tc2, answer1, answer2) 
            VALUES ('$topic','$difficulty','$question', '$tc1', '$tc2', '$answer1','$answer2');";
$question_ex = $db_conn->query($question_query);


if($question_ex == TRUE){
    $json_response = "Question Created!";
    echo json_encode($json_response);
}

$db_conn->close();
?>
