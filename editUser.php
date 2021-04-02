<?php
if(isset($_POST['updateUser'])){
    if($_SESSION['userRole']=='admin'){

    }else if($_SESSION['userRole']=='manager'){
        $userId=$_POST['userId'];
        $userName=$_POST['userName'];
        $userEmail=$_POST['userEmail'];
        $userRole=$_POST['userRole'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->updateInfoQuery($userId,$userName,$userEmail,$userRole);
            $managerObj->updateUserInfo($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
            echo "<div class=\"alert alert-success\" role=\"alert\">
            user is updated successfully
        </div>";
        }else{
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            You are not allowed to update $userRole
        </div>";
        }

    }else{
        $userId=$_SESSION['userId'];
        $userName=$_POST['userName'];
        $userEmail=$_POST['userEmail'];
        // $userRole = $_POST['userRole'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->updateInfoQuery($userId,$userName,$userEmail);
        $userObj=new userChange();
        $userObj->updateUserInfo($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<form action="" method="POST">
    <label >Enter User Id</label>
    <input type="text" class="form-control" name="userId" placeholder="Enter Id new user" required>
    <label >Enter User Name</label>
    <input type="text" class="form-control" name="userName" placeholder="Enter Name for new user" required>
    <label >Enter User Email</label>
    <input type="text"  name="userEmail" class="form-control" placeholder="enter email for new user" required>
    <!-- <label >Enter Role for the User</label>
    <input type="text" class="form-control" name="userRole" placeholder="enter role for new user" required> -->
    <button  class="btn btn-primary" name="updateUser">Update User</button>
</form>
</body>
</html>