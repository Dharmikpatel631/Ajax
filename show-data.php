<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="card">
        <h2 style="text-align: center;"><b>PHP CRUD operations using Bootstrap Modal</b></h2>
        <div class="card-body">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New user</button>
            <!-- <input type="button" class="btn btn-dark" id="load-button" value="Load Data"> -->
            <pre></pre>
            <div class="alert alert-success" role="alert" id="success-message"></div>
            <div id="table-data">



            </div>


            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="" id="addForm">

                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert" id="error-message"></div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" id="save-button">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update form User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div id="modal-form">

                           
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // $("#load-button").on("click", function(e) {

            //     $.ajax({
            //         url: "ajax-load.php",
            //         type: "POST",
            //         success: function(data) {
            //             $("#table-data").html(data);
            //         }
            //     });
            // });
            function loadTable() {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                });
            }
            loadTable();



            $("#save-button").on("click", function(e) {
                e.preventDefault();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                if (fname == "" || lname == "") {
                    $("#error-message").html("All fields are required.").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {
                            first_name: fname,
                            last_name: lname
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                                $("#addForm").trigger("reset");
                                $("#exampleModal").modal('hide');
                                $("#success-message").html("Data Inserted Successfully.").slideDown();
                                $("#error-message").slideUp();
                            } else {
                                $("#error-message").html("Can't Save Record.").slideDown();
                                $("#success-message").slideUp();
                            }

                        }
                    });
                }

            });



            $(document).on("click", ".delete-data", function() {
                if (confirm("Do you really want to delete this record ?")) {
                    var studentId = $(this).data("id");
                    var element = this;
                    // alert(studentId);
                    $.ajax({
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {
                            id: studentId
                        },
                        success: function(data) {
                            if (data == 1) {
                                $(element).closest("tr").fadeOut();
                            } else {
                                $("#error-message").html("Can't delete required.").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }
            });

            // modal show karva
            $(document).on("click", ".update-data", function() {
                // $("#modal").show();
                var studId = $(this).data("eid");
                // alert(studId);
                $.ajax({
                    url: "load-edit.php",
                    type: "POST",
                    data: {
                        sid: studId
                    },
                    success: function(data){
                        $("#modal-form").html(data);
                    }
                });
            });

            // modal hidde karva
            // $("#edit-submit").on("click", function(){
            //     $("#modal").hide();
            // });

            $(document).on("click","#edit-submit",function(){
                var student_ID = $("#edit-id").val();
                var student_fname = $("#edit-fname").val();
                var student_lname = $("#edit-lname").val();
                $.ajax({
                    url:"ajax-edit.php",
                    type: "POST",
                    data: {id: student_ID,fname:student_fname,lname:student_lname},
                    success: function(data){
                        // $("#modal").hide();
                        loadTable();
                        $("#exampleModal1").modal('hide');
                    }
                });
            });
            
        });
    </script>
</body>

</html>