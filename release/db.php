<?php

$host = "";
$user = "";
$dbpassword = "";
$db  = "";
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);
?>
