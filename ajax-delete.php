<?php
include "connection.php";

$student_id = $_POST["id"];

$result = mysqli_query($con,"DELETE FROM students WHERE id = {$student_id}")or die(mysqli_error($con));

if($result){
    echo 1;
}else{
    echo 0;
}
?>