<?php
include("db.php");

//assigns values to question variables for storing in questions table
$topic = $_POST['topic'];
$difficulty = $_POST['difficulty'];
$question = $_POST['question'];
$tc1 = $_POST['testcase1'];
$tc2 = $_POST['testcase2'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
// Testcase 3 and 4 can be NULL
$tc3 = $_POST['testcase3'];
$tc4 = $_POST['testcase4'];
// Answer3 and 4 can be NULL
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
// Constraints can be null as well
$forloop = $_POST['forloop'];
$printc = $_POST['print'];


$question_query = "INSERT INTO Questions (topic, difficulty, question, tc1, tc2, tc3, tc4, answer1, answer2, answer3, answer4, fconstraint, pconstraint) 
            VALUES ('$topic','$difficulty','$question', '$tc1', '$tc2', '$tc3', '$tc4', '$answer1','$answer2', '$answer3', '$answer4')";
$question_ex = $db_conn->query($question_query);


if($question_ex == TRUE){
    echo json_encode("Question Created!");
}
else{
    echo json_encode("Question not created")
}

$db_conn->close();
?>
