<?php
    if(isset($_POST['approveUserInfo'])){
        $userId=$_POST['userId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $userObj=new adminChange();
        $dbObj->connectDb();
        $queryObj->validateQuery($userId);
        $userObj->approveUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
        echo "<div class=\"alert alert-success\" role=\"alert\">
        user is approved successfully
    </div>";
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #Block End User;
    else if(isset($_POST['blockUserInfo'])){
        $userId=$_POST['userId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $userObj=new adminChange();
        $dbObj->connectDb();
        $queryObj->deValidateQuery($userId);
        $userObj->disApproveUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
        echo "<div class=\"alert alert-warning\" role=\"alert\">
        user is blocked successfully
    </div>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label >Enter User Id</label>
        <input type="text" class="form-control" name="userId" placeholder="Enter Id new user" required>
        <button  class="btn btn-primary" name="approveUserInfo">APPROVE</button>
        <button  class="btn btn-primary" name="blockUserINfo">BLOCK</button>
    </form>    
</body>
</html>
