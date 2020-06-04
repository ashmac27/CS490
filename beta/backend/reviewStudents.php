<?php
//For teacher to review and updates students grades and comments

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

$update_grade = "UPDATE Grades
                SET grade = '$grade'
                WHERE username = '$stu_username'";
$ugq = $db_conn->query($update_grade);


$i = 0;
foreach($comments as $value){
    $comments_answers = "UPDATE Grades
                         SET comments = '$value', student_answers = student_anserts+'$student_answers[$i]'
                         WHERE username = '$stu_username' and exam = '$exam'";
    $i++;
    $caq = $db_conn->query($comments_answers);
}

$set_to_graded = "UPDATE ExamRoster
                    SET status = 'graded'
                    WHERE username = '$stu_username'";
$stg = $db_conn->query($set_to_graded);



$db_conn->close();


?>
