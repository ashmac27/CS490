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


//Students clicks button with id exam to take it
$exam = $_POST['exam'];
if (isset($exam_post){
    $student_answers = "INSERT INTO StudentAnswers (exam, username, answer, total, comments)
                   VALUES ('$exam','null','null', 'null', 'null')";

    
    //$exam = mysqli_real_escape_string($_POST['exam']);
    $selecting_q = "SELECT questions, points FROM Exams WHERE exam = '$exam';";
    $result = $db_conn->query($selecting_q);
    $row = mysqli_fetch_row($result);
    $questions = explode(", ", $row[0]);
    $points_array = explode(", ", $row[1]);

    
    $j = 0;
    foreach ($questions as $i) {
        $new_query = "SELECT * FROM Questions WHERE question = '$question[$i]';";
        $new_query_result = $db_conn->query($new_query_result);
        while ($row = mysqli_fetch_assoc($new_query_result)) {
            $row_arr[$i]['topic'] = $row['topic'];
            $row_arr[$i]['difficulty'] = $row['difficulty'];
            $row_arr[$i]['question'] = $row['question'];
            $row_arr[$i]['tc1'] = $row['tc1'];
            $row_arr[$i]['tc2'] = $row['tc2'];
            $row_arr[$i]['points'] = $pt_array[$j];
            $j++;
        }
    }
    //returns a an array that could be displayed and formatted correctly on the screen
    echo json_encode($row_arr);

}

$db_conn->close();
?>