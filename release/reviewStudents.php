<?php
//For teacher to review and updates students grades and comments

include("db.php");

$exam=$_POST['exam'];
 $user=$_POST['user'];
 $corrections=unserialize($_POST['corrections']);
 $comments=unserialize($_POST['comments']);
 $qids=unserialize($_POST['qid']);
 
//echo "BE ";
var_dump($qids);
//echo '<br>'.count($qids);
 
$i = 0;
while(i < count($qids)){
      $a = "UPDATE Grades SET comments='$comments[$i]' where username='$user' and exam='$exam' and qid='$qids[$i]';";
      echo "heredbconn";
      echo $i." ".$a;
      echo '<br>';
      $result = $db_conn->query($a);
    
    $i=$i+1;
}

$i=0;
$j=0;
$k=0;

$item_arr = array("MethodName", "tc1", "tc2", "tc3", "tc4", "colon","print", "for");
while($i < count($corrections)){
    echo '<br>';
    $qry="UPDATE Item_Deductions SET teachergrade='$corrections[$i]'  where username='$user' and exam='$exam' and qid='$qids[$j]' and item='$item_arr[$k]'";
    echo $qry;
    echo '<br>';
    $result = $conn->query($qry); 
    $i=$i+1;
    $j=$i/8;
    $k=$i%8;
}
//var_dump($rows);
echo json_encode("Success");


/*

$exam = $_POST['exam'];
$stu_username = $_POST['student'];
$comments = unserialize($_POST['comments']);
$student_answers = unserialize($_POST['studentanswers']);

$update_grade = "UPDATE Grades
                SET deduction = '$deduction'
                WHERE username = '$stu_username'";
$ugq = $db_conn->query($update_grade);


$i = 0;
foreach($comments as $value){
    $comments_answers = "UPDATE Grades
                         SET comments = '$value', student_answers = student_answers+'$student_answers[$i]'
                         WHERE username = '$stu_username' and exam = '$exam'";
    $i++;
    $caq = $db_conn->query($comments_answers);
}

$set_to_graded = "UPDATE ExamRoster
                    SET status = 'graded'
                    WHERE username = '$stu_username'";
$stg = $db_conn->query($set_to_graded);

*/


$db_conn->close();


?>
