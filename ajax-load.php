<?php
include "connection.php";
$result = mysqli_query($con,"SELECT * FROM students")or die(mysqli_error($con));
$output = "";

if (mysqli_num_rows($result) > 0) {

    $output = '<table class="table table-borderless">
        <thead>
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
    <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr><td>{$row["id"]}</td><td>{$row["first_name"]}</td><td>{$row["last_name"]}</td><td><button class='btn btn-dark update-data' data-eid='{$row["id"]}' data-bs-toggle='modal' data-bs-target='#exampleModal1'>Update</button></td><td><button class='btn btn-danger delete-data' data-id='{$row["id"]}'>Delete</button></td></tr>";
    }

    $output .= " </tbody>
</table>";

    mysqli_close($con);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
?>
