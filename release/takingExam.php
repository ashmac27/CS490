<?php
//For purposes of the student to take his/her exam

include("db.php");

//Students clicks button with id exam to take it
$exam = $_POST['exam'];
if (isset($_POST['exam'])){
    $empty_grade= "INSERT INTO Grades(exam, qid, username, deduction, points_worth, comments, student_answers)
                   VALUES ('$exam','null','null', 'null', 'null', 'null', 'null')";
    $egx = $db_conn->query($empty_grade);


    $selecting_q = "SELECT question FROM Exams WHERE exam = '$exam'";
    $result = $db_conn->query($selecting_q);
    $row = mysqli_fetch_row($result);
    $questions = explode(", ", $row[0]);

    $row_arr = array();
    foreach ($questions as $i) {
        $new_query = "SELECT * FROM Questions WHERE question = '$i'";
        $new_query_result = $db_conn->query($new_query_result);
        while ($row = $new_query_result->fetch_assoc()) {
            $row_arr[$i]['qid'] = $row['qid'];
            $row_arr[$i]['topic'] = $row['topic'];
            $row_arr[$i]['difficulty'] = $row['difficulty'];
            $row_arr[$i]['question'] = $row['question'];
            $row_arr[$i]['tc1'] = $row['tc1'];
            $row_arr[$i]['tc2'] = $row['tc2'];
            $row_arr[$i]['tc3'] = $row['tc3'];
            $row_arr[$i]['tc4'] = $row['tc4'];
            $row_arr[$i]['answer1'] = $row['answer1'];
            $row_arr[$i]['answer2'] = $row['answer2'];
            $row_arr[$i]['answer3'] = $row['answer3'];
            $row_arr[$i]['answer4'] = $row['answer4'];
            $row_arr[$i]['fconstraint'] = $row['fconstraint'];
            $row_arr[$i]['pconstraint'] = $row['pconstraint'];
        }
    }
    //returns a an array 
    echo json_encode($row_arr);
}

$db_conn->close();
?>
