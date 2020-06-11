<?php
//For purposes of the student to take his/her exam

include("db.php");

//Students clicks button with id exam to take it
$exam = $_POST['exam'];
$username = $_POST['username'];
$ans = unserialize($_POST['ans']);

if (isset($_POST['exam'])){
    $empty_grade= "INSERT INTO Grades(exam, qid, username, deduction, points_worth, comments, student_answers)
                   VALUES ('$exam','null','null', 'null', 'null', 'null', 'null')";
    $egx = $db_conn->query($empty_grade);


    $selecting_q = "SELECT question FROM Exams WHERE exam = '$exam'";
    $result = $db_conn->query($selecting_q);
    //$row = mysqli_fetch_row($result);
    //$questions = explode(", ", $row[0]);
    //maybe take out vvvvv
    $questions = [];
    while($r = mysqli_fetch_assoc($result)){
        $questions[] = $r;
    }

    $row_arr = array();
    $i = 0;
    while ($questions[$i]["question"]) {
        $q=$questions[$i]["question"];        
    
        $new_query = "SELECT * FROM Questions WHERE question = '$q';";
        $new_query_result = $db_conn->query($new_query);
        
        while ($row = $new_query_result->fetch_assoc()) {
            $row_arr[$i]["qid"] = $row["qid"];
            $row_arr[$i]["topic"] = $row["topic"];
            $row_arr[$i]["difficulty"] = $row["difficulty"];
            $row_arr[$i]["question"] = $row["question"];
            $row_arr[$i]["tc1"] = $row["tc1"];
            $row_arr[$i]["tc2"] = $row["tc2"];
            $row_arr[$i]["tc3"] = $row["tc3"];
            $row_arr[$i]["tc4"] = $row["tc4"];
            $row_arr[$i]["answer1"] = $row["answer1"];
            $row_arr[$i]["answer2"] = $row["answer2"];
            $row_arr[$i]["answer3"] = $row["answer3"];
            $row_arr[$i]["answer4"] = $row["answer4"];
            $row_arr[$i]["fconstraint"] = $row["fconstraint"];
            $row_arr[$i]["pconstraint"] = $row["pconstraint"];
            $answer=$ans[$i];

        //call autograder
        $postRequest = array(
          'tc4' => $row["tc4"],
          'tc3' => $row["tc3"],
          'tc2' => $row["tc2"],
          'tc1' => $row["tc1"],
          'ans4'=> $row["answer4"],
          'ans3'=> $row["answer3"],          
          'ans2'=> $row["answer2"],
          'ans1'=> $row["answer1"],
          'question'=> $row["question"],
          'ans' => $answer);

          $cURLConnection = curl_init('https://web.njit.edu/~as2745/CS490Project/autograder.php');
    //$cURLConnection = curl_init('https://web.njit.edu/~am2829/cs490/takingExam.php');
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    
    //calling backend

    $graderres = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $json = json_decode($graderres);
     
     //echo 'AAAAA<br>';
     //var_dump($graderres);
      //echo 'BBBBB<br>';//$graderres[0].'BBBBBBBBB<br>';
     // var_dump($json);
    $comments=$graderres['comment1'];
    $score=-2;
    $comments=$json->comment1.';'.$json->comment2;
     //echo  $comments.'aaaa comm<br>';
     //echo  $json["score"].'bbbb score<br>';
    $score=$json->score;
     //echo  $score.'bbbb<br>';
    $student_answers = "INSERT INTO Grades (exam, username, deduction, points_worth, comments,student_answers) 
                         VALUES ('$exam','$ucid','$score','$comments', '$answer')";
    $saq = $db_conn->query($student_answers);
    
    //$update_grades_qid = "UPDATE Grades SET qid = '' WHERE username = $ucid";
    // Testing starts here
    $qid_arr = [];
    $getting_qid = "SELECT qid FROM Exams WHERE exam = '$exam'";
    $gqq = $db_conn->query($getting_qid);
    while($r = mysqli_fetch_assoc($result)){
        array_push($qid_arr, $r['qid']);
    }

    // Pull from questions array at line 22

    $j = 0;
    foreach($qid_arr as $i){
        $update_grades_qid = "UPDATE Grades SET qid = '$i' WHERE username = $ucid and question = '$questions[$j]'";
        $j++;
    }

    // Testing ends here



        //save it into db
        }
        $i=$i+1;
    }
}


$db_conn->close();
?>
