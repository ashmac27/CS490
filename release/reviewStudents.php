<?php
//For teacher to review and updates students grades and comments

//For teacher only

//Ashley Macote, CS490, Backend
function execQuery($qry){
$host = "";
$user = "";
$dbpassword = "";
$db  = "";


//echo '<br>'.qry;
 
//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);
$r=$db_conn->query($qry);
$db_conn->close();
    
    }
    
    $exm=$_POST['exam'];
 $auser=$_POST['userName'];
 $corrections=unserialize($_POST['corrections']);
 $comments=unserialize($_POST['comments']);
 $qids=unserialize($_POST['qid']);
 
//echo "BE ";
//var_dump($qids);
    
$i=0;
$j=count($qids);
$response = "fail";
//echo '<br>AAAAAAAAAAA'.$j.'<br>';
while($i<$j){
echo '<br>';
//exam, qid, username, deduction,comments
      $a="UPDATE Grades SET comments='$comments[$i]' where username='$auser' and exam='$exm' and qid='$qids[$i]';";
      //$question_query = "select * from Grades";
      //$result=$conn->query($question_query);
      //$result=$db_conn->query($a);
      //$r=$db_conn->query($a);
      execQuery($a);
      
      //echo '<br>';
      //echo $a;
      //echo '<br>';
      //$res=$conn->query($a);
      //echo 'SUCCESS<br>';
    
    $i=$i+1;
}
$i=0;
$j=0;
$k=0;
$item_arr = array("MethodName", "tc1", "tc2", "tc3", "tc4", "colon","print", "for");
while($i<count($corrections)){
//echo '<br>';
$b="update Item_Deductions set teachergrade='$corrections[$i]'  where username='$auser' and examname='$exm' and qid='$qids[$j]' and item='$item_arr[$k]'";
//echo $b.'<br>';
execQuery($b);
//echo $qry;
  //echo '<br>';
//$result = $conn->query($qry); 
$i=$i+1;
$j=$i/8;
$k=$i%8;
}

$set_to_graded = "UPDATE ExamRoster
                    SET status = 'graded'
                    WHERE username = '$auser' and exam = '$exm'";
execQuery($set_to_graded);

$response = "Success";
//var_dump($rows);
echo json_encode($response);


?>
