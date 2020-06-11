<?php
//For purposes of the student to take his/her exam

include("db.php");

//Students clicks button with id exam to take it
$exam = $_POST['exam'];
$username = $_POST['username'];
$qid = unserialize($_POST['qid']);
$ans = unserialize($_POST['ans']);


if (isset($_POST['exam'])){
    //$empty_grade= "INSERT INTO Grades(exam, qid, username, deduction, points_worth, comments, student_answers)
      //             VALUES ('$exam','null','null', 'null', 'null', 'null', 'null')";
    //$egx = $db_conn->query($empty_grade);

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

                'tc1' => $row["tc1"],
                'tc2' => $row["tc2"],
                'tc3' => $row["tc3"],
                'tc4' => $row["tc4"],
                'ans1'=> $row["answer1"],
                'ans2'=> $row["answer2"],
                'ans3'=> $row["answer3"],
                'ans4'=> $row["answer4"],  
                'fconstraint'=> $row["fconstraint"],
                'pconstraint'=> $row["pconstraint"],
                'question'=> $row["question"],
                'qid'=> $row["qid"],
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
            // Commenting  out VVV
            //comments=$graderres['comment1'];
            //$commentMethodName = $graderres['commentMethodName'];
            $scoreMethodName = $graderres['scoreMethodName'];
            //$printComment = $graderres['printComment'];
            $printScore = $graderres['printscore'];
            //$forComment = $graderres['forComment'];
            $forScore = $graderres['forScore'];
            //$colonComment = $graderres['commentColon'];
            $colonScore = $graderres['scoreColon'];
            //$commenttc1 = $graderres['commenttc1'];
            $scoretc1 = $graderres['scoretc1'];
            //$commenttc2 = $graderres['commenttc2'];
            $scoretc2 = $graderres['scoretc2'];
            //$commenttc3 = $graderres['commenttc3'];
            $scoretc3 = $graderres['scoretc3'];
            //$commenttc4 = $graderres['commenttc4'];
            $scoretc4 = $graderres['scoretc4'];   
           // $score=-2;
            //$comments=$json->$commentMethodName.';'.$json->$printComment.';'.$json->$forComment.';'.$json->$colonComment.';'.$json->$commenttc1.';'.$json->$commenttc2.';'.$json->$commenttc3.';'.$json->$commenttc4;
            $scores= $json->$scoreMethodName.';'.$json->$printScore.';'.$json->$forScore.';'.$json->$colonScore.';'.$json->$scoretc1.';'.$json->$scoretc2.';'.$json->$scoretc3.';'.$json->$scoretc4;
            //echo  $score.'bbbb<br>';
            

            $item_arr = array("scoreMethodName","printScore", "forScore", "colonScore", "scoretc1", "scoretc2", "scoretc3", "scoretc4");
            $scores_arr = array("$scoreMethodName","$printScore", "$forScore", "$colonScore", "$scoretc1", "$scoretc2", "$scoretc3", "$scoretc4");

            $k = 0;
            foreach($qid as $value){
               // $student_answers = "INSERT INTO Grades (exam, qid, username, deduction, comments,student_answers) 
                //VALUES ('$exam','$k', $username','$scores','$comments', '$answer')";
                $student_answers = "INSERT INTO Grades (exam, qid, username, deduction,comments, student_answers) 
                VALUES ('$exam','$value', $username','$scores', NULL, '$answer')";
                $saq = $db_conn->query($student_answers);

                $item_deductions = "INSERT INTO Item_Deductions
                                    VALUE('$username', '$exam', '$value', '$item_arr[$k]','$scores_arr[$k]', NULL)";
                $idq = $db_conn->query($item_deductions);

                $k++;
            }







            //$student_answers = "INSERT INTO Grades (exam, username, deduction, points_worth, comments,student_answers) 
            //                   VALUES ('$exam','$username','$score','$comments', '$answer')";
            //$saq = $db_conn->query($student_answers);
            
            //$update_grades_qid = "UPDATE Grades SET qid = '' WHERE username = $ucid";
            // Testing starts here
        //$qid_arr = [];
            //$getting_qid = "SELECT qid FROM Exams WHERE exam = '$exam'";
            //$gqq = $db_conn->query($getting_qid);
            //while($r = mysqli_fetch_assoc($result)){
            //  array_push($qid_arr, $r['qid']);
        // }

            // Pull from questions array at line 22

        /*
        Last one commented out...

            foreach($qid as $i){
                // I don't have the question association in the grades table
                //Old one 
                //$update_grades_qid = "UPDATE Grades SET qid = '$i' WHERE username = $username and question = '$questions[$j]'";
                $update_grades_qid = "UPDATE Grades SET qid = '$i' WHERE username = $username";
                $ugq = $db_conn->query($update_grades_qid);
                //$j++;
            }
            */
        /*
            $update_grades_qid = "UPDATE Grades
                                SET g.qid = q.qid , 
                                FROM Grades AS g
                                INNER JOIN Questions AS q ON g.qid = q.qid;
                                WHERE q.question IN
                                    (SELECT E.question
                                    FROM Exams as E, Questions as Q
                                    WHERE E.qid = E.qid)";
        */
            // Testing ends here



                //save it into db
        }
        $i=$i+1;
    }
}


$db_conn->close();
?>
