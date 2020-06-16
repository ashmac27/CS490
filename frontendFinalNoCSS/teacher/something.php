<?php
 $usr='am123';
 $pass='password';
 $role='Student';

   $postRequest = array(
    'username' => $usr,
    'password' => $pass,
    'role' => $role);


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
$question_query = "select * from Questions";
$question_query5 = "select * from ExamRoster ";
$question_query6 = "show tables";
$question_query7 = "select * from Item_Deductions";
$question_query2 = "Select distinct username from Grades";
$question_query3 = "Insert INTO Grades (exam,username,student_answers,grade,comments) VALUES ('Midterm1','am123','aaaaa2aaa','-6','commentssss;coments3')";
$question_query4 = "Truncate Table Exams";
//$result=$db_conn->query($question_query);
$result2=$db_conn->query($question_query);
$i=1;

while( $row = mysqli_fetch_array($result2) )
{//topic, difficulty, question, tc1, tc2, answer1, answer2
    //echo $i.'. '.$row['username'] . " " . $row['exam']. " " . $row['grade']. " " . $row['comments'];
    print_r($row);
    echo "<br />";
    $i=$i+1;
}
$json_response = json_encode($response);
//echo $json_response;

$db_conn->close();
?>
   