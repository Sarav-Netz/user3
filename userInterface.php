<?php
    session_start();
    if($_SESSION['userRole']){
        include('db.php'); #this will include the data of the Database and queries;
        include('userHandlerClasses.php');
        include('userHandlerQueries.php');
    }else{
        header("Location:admin.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>UserDashboard</title>
</head>
<body>
    <div class="jumbotron bg-dark">
        <h3 class="text-warning">This Dashboard is a simple page Whose purpose is just to Provide information about a specific User.</h3>
    </div>
    <div class="container">
        <form action="" method="POST"></br>
        <button class="btn btn-danger" name="showDetailClick">Showdetail</button></br>
        <button class="btn btn-danger" name="logoutClick">Logout</button>
        </form>
        <div>
            <button name="updateInfoModal" data-toggle="modal" data-target="#updationInfoModal" class="btn btn-secondary">Update Your Information</button>
            <div class="modal" id="updationInfoModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Updation form</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <input type="text" class="form-control" name="userId" placeholder="Enter Your ID.">
                                <input type="text"  name="userName" class="form-control" placeholder="enter Your name">
                                <input type="text" class="form-control" name="userEmail" placeholder="enter email" >
                                <button  class="btn btn-primary" name="updateInfo">update User</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button name="updatePasswordModal" data-toggle="modal" data-target="#updatePasswordModal" class="btn btn-secondary">Update Your password</button>
            <div class="modal" id="updatePasswordModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update password form</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <input type="text" class="form-control" name="userId" placeholder="Enter Your Id">
                                <input type="text"  name="userEnteredPassword" class="form-control" placeholder="enter new password">
                                <input type="text" class="form-control" name="userConformationPassword" placeholder="enter password again" >
                                <button  class="btn btn-primary" name="updatePassword">update User</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>