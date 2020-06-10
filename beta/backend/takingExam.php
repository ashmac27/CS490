<?php

//Ashley Macote, CS490, Backend
$host = "";
$user = "";
$dbpassword = "";
$db  = "";
//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);



    
//Students clicks button with id exam to take it
$exam = $_POST['exam'];
if (isset($_POST['exam'])){
    $student_answers = "INSERT INTO StudentAnswers (exam, username, student_answer, grade, comments)
                   VALUES ('$exam','null','null', 'null', 'null')";
    $saq = $db_conn->query($student_answers);


    $selecting_q = "SELECT questions FROM Exams WHERE exam = '$exam'";
    $result = $db_conn->query($selecting_q);
    $row = mysqli_fetch_row($result);
    $questions = explode(", ", $row[0]);

    $row_arr = array();
    foreach ($questions as $i) {
        $new_query = "SELECT * FROM Questions WHERE question = '$question[$i]';";
        $new_query_result = $db_conn->query($new_query_result);
        while ($row = $new_query_result->fetch_assoc()) {
            $row_arr[$i]['topic'] = $row['topic'];
            $row_arr[$i]['difficulty'] = $row['difficulty'];
            $row_arr[$i]['question'] = $row['question'];
            $row_arr[$i]['tc1'] = $row['tc1'];
            $row_arr[$i]['tc2'] = $row['tc2'];
            $row_arr[$i]['answer1'] = $row['answer1'];
            $row_arr[$i]['answer2'] = $row['answer2'];
        }
    }
    //returns a an array that could be displayed and formatted correctly on the screen
    echo json_encode($row_arr);
}

$username = $_POST['username'];
$student_answer = $_POST['answer'];

$db_conn->close();
?>
