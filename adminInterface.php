<?php
    #This Page is just for the Admin Use not any other member of the website;
    
    session_start();  #this will start the session
    $validMember=FALSE;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->
  
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->
    <script>
        $(document).ready( function () {
            $('#showAllMemberToAdmin').click(function(){
                $("#allDetailTable").toggle();
                // $('#hide').text("Show Table");
            });
        } );
        
    </script>
    <script>
        function showAllMember(){
            console.log("yes i'm working");
        }
        function newmember(){
            location.reload();
            location.href='addnew.php';
            // parent.location='addnew.php';
        }
    </script>
    <title>UserDashboard</title>
</head>
<body>
    <?php include('navbar.php');?>
    <div class="container">
        <!-- <button id="hide">hide</button>
        <form action="" method="POST"></br>
        <button class="btn btn-danger" name="showMyDetailClick">Showdetail</button>
        <button class="btn btn-danger" name="logoutClick">Logout</button>
        <button id="showAllMember" name="showAllMember" class="btn bg-primary">Show all Members</button>
        <button name="myToDoList" class="btn bg-primary">My ToDo List.</button> -->
        <!-- <button name="newToDo" class="btn bg-primary">Add new Task.</button></br></br> -->
        <!-- </form> -->
        <div id="allDetailTable">
        <table class="table" >
            <thead>
                <tr>
                    <th scope="col">SR. no.</th>
                    <th scope="col">USER Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
                    <th scope="col">User Role</th>
                    <th scope="col">User Approval</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($validMember){
                #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
                # Condition to show members;
                if(isset($_GET['showAllMember'])){
                    $dbObj=new dbConnection();
                    $queryObj=new createQuery();
                    $userObj=new adminChange();
                    $dbObj->connectDb();
                    $queryObj->selectAllUserQuery();                    
                    $table=$userObj->showAllUserToAdmin($dbObj->con,$queryObj->myQuery);
                    $dbObj->dissconnectDb();
                    if($table){
                        $srNo=0;
                        while($row=$table->fetch_assoc()){
                            $srNo+=1;
                            echo "<tr>
                            <td>".$srNo."</td>
                            <td>".$row['userId']."</td>
                            <td>".$row['userName']."</td>
                            <td>".$row['userEmail']."</td>
                            <td>".$row['userRole']."</td>
                            <td>".$row['valid']."</td>
                            <td>"
                                ."<a href=editUser.php class='link'> Edit </a>|".
                                "<a href=validateUser.php> Validate</a>|".
                                "<a href=deleteUser.php> Delete</a>".
                            "</td>"
                            ."</tr>";
                        }
                    }
                }
            }
            ?>
            </tbody>
        </table>
            
        </div>
        <!-- <div>
            <button name="updateInfoModal" data-toggle="modal" data-target="#updationInfoModal" class="btn btn-secondary">Update User Information</button></br></br>
            <div class="modal" id="updationInfoModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Updation form</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <input type="text" class="form-control" name="userId" placeholder="Enter user ID.">
                                <input type="text"  name="userName" class="form-control" placeholder="enter user name">
                                <input type="text" class="form-control" name="userEmail" placeholder="enter email" >
                                <button  class="btn btn-primary" name="updateInfo">update User</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div>
            <button name="updatePasswordModal" data-toggle="modal" data-target="#updatePasswordModal" class="btn btn-secondary">Update password</button></br></br>
            <div class="modal" id="updatePasswordModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update password form</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label >Enter Id</label>
                                <input type="text" class="form-control" name="userId" placeholder="Enter Id">
                                <label >Enter New Password</label>
                                <input type="text"  name="userEnteredPassword" class="form-control" placeholder="enter new password">
                                <label >Confirm Password</label>
                                <input type="text" class="form-control" name="userConformationPassword" placeholder="enter password again" >
                                <button  class="btn btn-primary" name="updatePassword">update Password</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div>
            <!-- <button name="addUserModal1" data-toggle="modal" data-target="#addUserModal" class="btn btn-secondary">Add New User</button></br></br> -->
            <div class="modal" id="addUserModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add new user Form</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label >Enter User Name</label>
                                <input type="text" class="form-control" name="newUserName" placeholder="Enter Name for new user">
                                <label >Enter User Email</label>
                                <input type="text"  name="newUserEmail" class="form-control" placeholder="enter email for new user">
                                <label >Enter Role for the User</label>
                                <input type="text" class="form-control" name="newUserRole" placeholder="enter role for new user" >
                                <label >Enter Password</label>
                                <input type="text"  name="newUserPassword" class="form-control" placeholder="enter password for new user">
                                <label >Validate User</label>
                                <input type="text"  name="newUservalid" class="form-control" placeholder="yes/no">
                                <button  class="btn btn-primary" name="addNewUser">Add User</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
            <button name="updatePasswordModal" data-toggle="modal" data-target="#taskEditor" class="btn btn-secondary">Add new Task</button></br></br>
            <div class="modal" id="taskEditor" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Task Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label >Enter Id</label>
                                <input type="text" class="form-control" name="userId" placeholder="Enter Id">
                                <label >Enter New Task</label>
                                <input type="text"  name="newTask" class="form-control" placeholder="enter new Task">
                                <button  class="btn btn-primary" name="newToDo">Add Task</button>
                                <button  class="btn btn-default"  data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div>
            <form action="" method="POST">
                <input type="text" name="randomQueryUserId" placeholder="enter user id" require>
                <button class="btn btn-primary bg-dark" name="otherUserInfo">Show Info</button>
                <button class="btn btn-primary bg-dark" name="otherUserDeletion">DeleteUser</button>
                <button class="btn btn-primary bg-dark" name="approveUserInfo">Approve User</button>
                <button class="btn btn-primary bg-dark" name="blockUserInfo">Block User</button>
            </form>
        </div>     -->
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