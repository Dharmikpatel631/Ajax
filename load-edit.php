<?php 
include "connection.php";

$student_id = $_POST["sid"];

$result = mysqli_query($con,"SELECT * FROM students WHERE id={$student_id}")or die(mysqli_error($con));
$output = "";

if (mysqli_num_rows($result) > 0) {

    
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "
        
        <div class='modal-body'>
        <div class='alert alert-danger' role='alert' id='error-message'></div>
        <div class='mb-3'>
            <label for='exampleInputEmail1' class='form-label'>First Name</label>
            <input type='text' class='form-control' id='edit-fname' value='{$row["first_name"]}' aria-describedby='emailHelp'>
            <input type='text' class='form-control' hidden id='edit-id' value='{$row["id"]}' aria-describedby='emailHelp'>
        </div>
        <div class='mb-3'>
            <label for='exampleInputPassword1' class='form-label'>Last Name</label>
            <input type='text' class='form-control' value='{$row["last_name"]}' id='edit-lname'>
        </div>

    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-dark' id='edit-submit'>Save changes</button>
    </div>";
    }

   

    mysqli_close($con);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
?>