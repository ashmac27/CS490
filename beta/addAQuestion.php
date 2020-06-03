<?php

$host = "";
$user = "";
$dbpassword = "";
$db  = "";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);

$response = "fail";

$qid = mysqli_real_escape_string($_POST['qid']);
$topic = mysqli_real_escape_string($_POST['topic']);
$difficulty = mysqli_real_escape_string($_POST['difficulty']);
$input = mysqli_real_escape_string($_POST['input']);
$output = mysqli_real_escape_string($_POST['output']);
$question = mysqli_real_escape_string($_POST['question']);

$question_query = "INSERT INTO Questions (id, topic, difficulty, input, output, question)
                    VALUES ('$id','$topic','$difficulty','$input','$output','$question');";

if($db_conn->query($question_query))
    $response = "success";


$json_response = json_encode($response);
echo $json_response

$db_conn->close();
?>
