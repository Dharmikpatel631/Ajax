<?php
include "connection.php";

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$result = mysqli_query($con,"INSERT INTO students(first_name, last_name) VALUES ('{$first_name}','{$last_name}')")or die(mysqli_error($con));

if($result){
    echo 1;
}else{
    echo 0;
}
?>