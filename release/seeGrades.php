<?php

//for student to see his/her grades being displayed

include("db.php");

/*
$student_username = $_POST['username'];
$teacherGradeArr = array();
$see_grades = "SELECT teachergrade 
                FROM Item_Deductions 
                WHERE username = '$student_username'";

*/

/*

$student_username = $_POST['username'];
//Query to get all the information from the Grades Table for a student
$see_grades = "SELECT username, exam, grade, comments, student_answers 
            FROM Grades WHERE username = '$student_username'";
$sg_query = $db_conn->query($see_grades);
$row = $sg_query->fetch_assoc();
$grade = $row['grade'];
$exam = $row['exam'];
$comments = $row['comments'];
$student_answers = $row['student_answers'];

if($sg_query-> num_rows == 1){
    $my_obj->username = "$username";
    $my_obj->exam = "$exam";
    $my_obj->grade = "$grade";
    $my_obj->comments = "$comments";
    $my_obj->student_answers = "$student_answers";
}

//encoding json response
echo json_encode($my_obj); 
$db_conn->close();
*/

$student_username = $_POST['ucid'];
$type=$_POST['type'];

if($type == 'select')
  $qry = "SELECT qid, deduction, student_answers, comments FROM Grades WHERE username='$student_username'";

$result = $db_conn->query($qry); 

$rows = array();
while($r = mysqli_fetch_assoc($result)){
  $qid=$r['qid'];
  $teacheGrade="SELECT GROUP_CONCAT(teachergrade) as teachergrade FROM Item_Deductions WHERE username='$ucid' and qid='$qid'";
  $res = $db_conn->query($teacheGrade); 
  $s = mysqli_fetch_assoc($res);

  $r['teachergrade']=$s['teachergrade'];
  $rows[] = $r;
}
//var_dump($rows);
//echo json_encode($rows);

echo json_encode($rows);

?>
