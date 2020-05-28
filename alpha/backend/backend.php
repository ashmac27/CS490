<?php
//CS490, Backend
$host = "";
$user = "";
$dbpassword = "";
$db  = "";

//Defining the variables and hashing the password using md5
$username = $_POST['username'];
$role = $_POST['role'];
$password = $_POST['password'];
$hashed_password = md5($password);

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);

//Query to see if the login info matches a record from the table
$login_query = "SELECT * FROM login WHERE (username LIKE '$username' AND password LIKE '$hashed_password' 
                AND role LIKE '$role')";
$executed_query = $db_conn->query($login_query);

//Gets the number of rows which should = 1 considering only one login for user.
//If query gives 1 row, then the user is verified. Else, they aren't
if($executed_query-> num_rows == 1){
    $my_obj->status = "verified";
    $my_obj->username = "$username";
    $my_obj->role = "$role";
}else
    $my_obj->status= "unverified";

//encoding json response
$json_response = json_encode($my_obj);                                                                                   
echo $json_response;
$db_conn->close();
?>
