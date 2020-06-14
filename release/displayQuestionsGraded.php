<?php

include("db.php");

//Subquery that connects username from ExamRoster table to Exams table
$username = $_POST['username'];
$display_exam = "SELECT exam, qid, question, points FROM Exams WHERE exam in
                    (SELECT distinct exam FROM ExamRoster
                    WHERE status = 'graded' and username ='$username')";    

$deq = $db_conn->query($display_exam);
$rows = array();
while($r = mysqli_fetch_assoc($deq)){
    $rows[] = $r;
}

echo json_encode($rows);


$db_conn->close();

?>
