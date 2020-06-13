<?php

include("db.php");

//the student's username 
$username = $_POST['username'];

$see_grades = "SELECT distinct username FROM Grades";
$sg_query = $db_conn->query($see_grades);
$rows = array();
while($r = mysqli_fetch_assoc($sg_query)){
    $rows[] = $r;
}

echo json_encode($rows);
//encoding json response
//echo json_encode($my_obj); 
$db_conn->close();
?>
