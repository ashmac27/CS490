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
//$exam = $_POST['exam'];
//$username = $_POST['username'];
//
//$select_ungraded = "SELECT distinct exam FROM ExamRoster
  //                   WHERE status = 'ungraded' and username ='$username'";
//$suq = $db_conn->query($select_ungraded);


$username = $_POST['username'];

$display_exam = "SELECT exam, questions FROM Exams WHERE exam = 
                    (SELECT distinct exam FROM ExamRoster
                    WHERE status = 'ungraded' and username ='$username')";    
$deq = $db_conn->query($display_exam);
$rows = array();
while($r = mysqli_fetch_assoc($sqq)){
    $rows[] = $r;
}
echo json_encode($rows);

$db_conn->close();
?>
