<?php

$host = "";
$user = "";
$dbpassword = "";
$db  = "";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);




    
$selecting_q = "SELECT * FROM Questions";    
$sqq = $db_conn->query($selecting_q);
$rows = array();
while($r = mysqli_fetch_assoc($sqq)){
    $rows[] = $r;
}
echo json_encode($rows);

$db_conn->close();
?>
