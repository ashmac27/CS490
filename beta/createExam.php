<?php


$host = "";
$user = "";
$dbpassword = "";
$db  = "";

//Connecting to mysql
$db_conn = mysqli_connect ($host, $user, $dbpassword, $db);
if($db_conn-> connect_error)
    die("Connection failure: ". $db_conn -> connect_error);

$response = "fail";
$exam =  mysqli_real_escape_string($_POST['exam_title']);
//question bank should be an unordered list with the id question_bank
$questions_array =  mysqli_real_escape_string($_POST['question_bank']);
$points = mysqli_real_escape_string($_POST['points']);

//foreach($i in $question_array_str)


$query = "SELECT username FROM login WHERE role='student';";
$result = $db_conn->query($query);
if($result != TRUE){
    j_str = json_encode($response);
    echo j_str;
    $db_conn->close();
    exit;
}

$students_selected = [];

while($row = $result->fetch_assoc()){
    array_push($students_assigned, $row['username']);
}

$student_status = "ungraded";
$status = "undelivered"
foreach ($students_assigned as $username) {
    $exam_roster_query = "INSERT INTO ExamRoster(username, exam, status)
                            VALUES('$username','$exam','$student_status');";
}

$add_exam_q = "INSERT INTO Exams (exam, questions, points, status)
                VALUES ('$exam','$questions_array','$points','$status')";

//if teacher decides to click to send the exam to students
if($_POST(['deliver_exam'])){
    $deliver_exam_q = "UPDATE ExamRoster SET status = 'delivered' WHERE exam = '$exam'";
}

$response = "Success";
echo json_encode($response);

$db_conn->close();
?>
