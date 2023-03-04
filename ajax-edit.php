<?php
include "connection.php";

$student_id = $_POST["id"];
$student_fname = $_POST["fname"];
$student_lname = $_POST["lname"];
$result = mysqli_query($con,"UPDATE students SET first_name='{$student_fname}',last_name='{$student_lname}' WHERE id = {$student_id}")or die(mysqli_error($con));

if($result){
    echo 1;
}else{
    echo 0;
}
?>