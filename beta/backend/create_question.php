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

$topic = mysqli_real_escape_string($_POST['topic']);
$difficulty = mysqli_real_escape_string($_POST['difficulty']);
$question = mysqli_real_escape_string($_POST['question']);
$tc1 = mysqli_real_escape_string($_POST['testcase1']);
$tc2 = mysqli_real_escape_string($_POST['testcase2']);
$answer1 = mysqli_real_escape_string($_POST['answer1']);
$answer2 = mysqli_real_escape_string($_POST['answer2']);

$question_query = "INSERT INTO Questions (topic, difficulty, question, tc1, tc2, answer1, answer2)
                    VALUES ('$topic','$difficulty','$question', '$tc1', '$tc2', '$answer1','$answer2')";

if($db_conn->query($question_query))
    $response = "Success! You created a question";

$json_response = json_encode($response);
echo $json_response;

$db_conn->close();
?>
