<?php
//Ashley Macote, CS490, Backend
$host = "sql1.njit.edu";
$user = "am2829";
$dbpassword = "urLNjFMv";
$db  = "am2829";

//Defining the variables and hashing the password using md5
$username = $_POST['username'];
$password = $_POST['password'];
$hashed_password = md5($password);

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);

// SQL query and finding the role of the user     
$select_role = "SELECT role FROM login WHERE (username LIKE '$username' AND password LIKE '$hashed_password')";
$sr_query = $db_conn->query($select_role);
$row = $sr_query->fetch_assoc();
$role = $row['role'];
if($sr_query-> num_rows == 1){
    $my_obj->status = "verified";
    $my_obj->username = "$username";
    $my_obj->role = "$role";
}
else    
    $my_obj->status= "unverified";

//encoding json response
$json_response = json_encode($my_obj);                                                                                   
echo $json_response;
$db_conn->close();
?>