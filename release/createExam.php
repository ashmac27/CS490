<?php

include("db.php");

// Gets ahold of questions and points array
$exam = $_POST['exam_title'];
$questions_array = unserialize($_POST['questions']);
$points = unserialize($_POST['points']);
//new
$qids = unserialize($_POST['qid']);

//Query to select students to take the exam
$query = "SELECT username FROM login WHERE role ='student';";
$result = $db_conn->query($query);

$students_selected = [];
while($row = $result->fetch_assoc()){
    array_push($students_selected, $row['username']);
}

 
$student_status = "ungraded";
foreach ($students_selected as $i) {
    $exam_roster_insert = "INSERT INTO ExamRoster(username, exam, status)
                          VALUES('$i','$exam','$student_status');";
    $erq = $db_conn->query($exam_roster_insert);
}

$j = 0;
foreach($questions_array as $value){
    $add_exam = "INSERT INTO Exams(exam, qid, question, points)
                  VALUES ('$exam','$qids[$j]','$value','$points[$j]')";
    //var_dump($add_exam);
    $aeq = $db_conn->query($add_exam);
    $j++;
}

$db_conn->close();
?>

