<?php
// session_start();
if($_SESSION['userRole']=="manager"){
    $validMember=TRUE;
    #>>>>>>>>>>>>><<<<<<<<<<<<
    #Current User Info
    if(isset($_POST['showMyDetailClick'])){
        $userId=(int)$_SESSION['userId'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->selectWithCond($userId);
        $userObj=new managerChange();
        $userObj->showUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #>>>>>>>>>>>>><<<<<<<<<<<<
    #Log Out Condition
    else if (isset($_POST['logoutClick'])) {
        session_destroy();
        // echo '<script>alert("You clicked me! Now i\'m logging you out")</script>';
        header("Location:manager.php");
    }
    #>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<
    #Udate Information condition
    else if(isset($_POST['updateInfo'])){
        $userId=$_POST['userId'];
        $userName=$_POST['userName'];
        $userEmail=$_POST['userEmail'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->updateInfoQuery($userId,$userName,$userEmail);
            $managerObj->updateUserInfo($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #--------->>>>>>>>>>>><<<<<<<<<<<<<--------
    # Password updation command
    elseif (isset($_POST['updatePassword'])) {
        $userId=$_POST['userId'];
        $userEnteredPassword=$_POST['userEnteredPassword'];
        $userConformationPassword=$_POST['userConformationPassword'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            if($userEnteredPassword==$userConformationPassword){
                $userEnteredPassword=sha1($userEnteredPassword);
                $queryObj->updatePassword($userId,$userEnteredPassword);
                $managerObj->updateUserPassword($dbObj->con,$queryObj->myQuery);
                $dbObj->dissconnectDb();
            }else{
                echo '<script>alert("please enter password carefully!")</script>';
            }
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #>>>>>>>>>>>>><<<<<<<<<<<<
    #this condition will work to add new user
    // else if(isset($_POST['addNewUser'])){
    //     $userName=$_POST['newUserName'];
    //     $userEmail=$_POST['newUserEmail'];
    //     $userRole=$_POST['newUserRole'];
    //     $userRole=strtolower($userRole);
    //     $userPassword=$_POST['newUserPassword'];
    //     $userPassword=sha1($userPassword);
    //     $valid=$_POST['newUserValid'];
    //     $valid=strtolower($valid);
    //     if($userRole!='admin' && $userRole!="manager"){
    //         $dbObj=new dbConnection();
    //         $dbObj->connectDb();
    //         $queryObj=new createQuery();
    //         $queryObj->addUserQuery($userName,$userEmail,$userRole,$userPassword,$valid);
    //         $userObj=new managerChange();
    //         $userObj->addNewUser($dbObj->con,$queryObj->myQuery);
    //         $dbObj->dissconnectDb();
    //     }else{
    //         echo '<script>alert("You are allowed to add staff members only")</script>';
    //     }
    // }
    #----------->>>>>>>>><<<<<<<<<<<<<<<<-------------
    # information of user other than the current User
    else if(isset($_POST['otherUserInfo'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->selectWithCond($userId);
            $table = $managerObj->showUser($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #--->>>>>>>>>>>>><<<<<<<<<<<<------
    #Deletion of the end users bu manager
    else if(isset($_POST['otherUserDeletion'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->deleteQuery($userId);
            $managerObj->deleteAnyUser($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #>>>>>>>>>>>>><<<<<<<<<
    #condition to validate User
    else if(isset($_POST['approveStaff'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->validateQuery($userId);
            $managerObj->validateStaff($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<
    #devalidate any user
    else if(isset($_POST['disApproveStaff'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $managerObj=new managerChange();
        $dbObj->connectDb();
        $queryObj->selectWithCond($userId);
        $managerObj->allowToChange($dbObj->con,$queryObj->myQuery);
        if($managerObj->makeChange){
            $queryObj->deValidateQuery($userId);
            $managerObj->deValidateStaff($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("You are not allowed to do this task")</script>';
        }
    }
    #>>>>>>>>>>>>>><<<<<<<<<<<<<
    # SHow all member accept admin and manager
    else if(isset($_POST['showAllMember'])){
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->selectAllUserQuery();
        $userObj=new managerChange();
        $table=$userObj->showAllUserToManager($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #<<<<<<<<<<<<>>>>>>>>>>>
    #showing your pending tasks
    else if(isset($_POST['myToDoList'])){
        echo '<script>alert("i am in the process!")</script>';
    }
}elseif($_SESSION['userRole']!='admin'&& $_SESSION['userRole']!='manager'){
    if(isset($_POST['showDetailClick'])){
        $userId=(int)$_SESSION['userId'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->selectWithCond($userId);
        $userObj=new userChange();
        $table = $userObj->showUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }else if (isset($_POST['logoutClick'])) {
        session_destroy();
        // echo '<script>alert("You clicked me! Now i\'m logging you out")</script>';
        header("Location:logout.php");
    }else if(isset($_POST['updateInfo'])){
        $userId=$_POST['userId'];
        $userName=$_POST['userName'];
        $userEmail=$_POST['userEmail'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->updateInfoQuery($userId,$userName,$userEmail);
        $userObj=new userChange();
        $userObj->updateUserInfo($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }elseif (isset($_POST['updatePassword'])) {
        $userId=$_POST['userId'];
        $userEnteredPassword=$_POST['userEnteredPassword'];
        $userConformationPassword=$_POST['userConformationPassword'];
        if($userEnteredPassword==$userConformationPassword){
            $userEnteredPassword=sha1($userEnteredPassword);
            $dbObj=new dbConnection();
            $dbObj->connectDb();
            $queryObj=new createQuery();
            $queryObj->updatePassword($userId,$userEnteredPassword);
            $userObj=new userChange();
            $userObj->updateUserPassword($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("please enter password carefully!")</script>';
        }
    }
}elseif($_SESSION['userRole']=="admin"){
    $validMember=TRUE;
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #User information updation Command or Query;
    if(isset($_POST['updateInfo'])){
        $userId=$_POST['userId'];
        $userName=$_POST['userName'];
        $userEmail=$_POST['userEmail'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->updateInfoQuery($userId,$userName,$userEmail);
        $userObj=new adminChange();
        $userObj->updateUserInfo($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #Password Updation Condition;
    elseif (isset($_POST['updatePassword'])) {
        $userId=$_POST['userId'];
        $userEnteredPassword=$_POST['userEnteredPassword'];
        $userConformationPassword=$_POST['userConformationPassword'];
        if($userEnteredPassword==$userConformationPassword){
            $userEnteredPassword=sha1($userEnteredPassword);
            $dbObj=new dbConnection();
            $dbObj->connectDb();
            $queryObj=new createQuery();
            $queryObj->updatePassword($userId,$userEnteredPassword);
            $userObj=new adminChange();
            $userObj->updateUserPassword($dbObj->con,$queryObj->myQuery);
            $dbObj->dissconnectDb();
        }else{
            echo '<script>alert("please enter password carefully!")</script>';
        }
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    # Add new end User;
    else if(isset($_POST['addNewUser'])){
        $userName=$_POST['newUserName'];
        $userEmail=$_POST['newUserEmail'];
        $userRole=$_POST['newUserRole'];
        $userRole=strtolower($userRole);
        $userPassword=$_POST['newUserPassword'];
        $newUservalid=$_POST['newUservalid'];
        $userPassword=sha1($userPassword);
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->addUserQuery($userName,$userEmail,$userRole,$userPassword,$newUservalid);
        $userObj=new adminChange();
        $userObj->addNewUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #End User Information;
    else if(isset($_POST['otherUserInfo'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->selectWithCond($userId);
        $userObj=new adminChange();
        $userObj->showUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #Delete any End User;
    else if(isset($_POST['otherUserDeletion'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createQuery();
        $queryObj->deleteQuery($userId);
        $userObj=new adminChange();
        $userObj->deleteAnyUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #approve End user;
    else if(isset($_POST['approveUserInfo'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $userObj=new adminChange();
        $dbObj->connectDb();
        $queryObj->validateQuery($userId);
        $userObj->approveUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
    #Block End User;
    else if(isset($_POST['blockUserInfo'])){
        $userId=$_POST['randomQueryUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createQuery();
        $userObj=new adminChange();
        $dbObj->connectDb();
        $queryObj->deValidateQuery($userId);
        $userObj->disApproveUser($dbObj->con,$queryObj->myQuery);
        $dbObj->dissconnectDb();
    }
    
    #<<<<<<<<<<<<>>>>>>>>>>>
    #showing your pending tasks;
    else if(isset($_POST['myToDoList'])){
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $myQuery="SELECT * FROM `usertodo` WHERE `userId`=1 ";
        $table=mysqli_query($dbObj->con,$myQuery);
        $srNo=0;
        while($row=$table->fetch_assoc()){
            $srNo+=1;
            echo "($srNo)".$row['userTodo']."<button class=\"btn btn-danger\" name='todoDelete'>Delete </button>"."</br>";
        }
        // echo '<script>alert("i am in the process!")</script>';

    }
    #<<<<<<<<<<<<>>>>>>>>>>>
    #delete tasks;
    else if(isset($_POST['todoDelete1'])){
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $myQuery="DELETE FROM `usertodo` WHERE `userId`=1 ";
        $table=mysqli_query($dbObj->con,$myQuery);
        $srNo=0;
        while($row=$table->fetch_assoc()){
            $srNo+=1;
            echo "($srNo)".$row['userTodo']."<button class=\"btn btn-danger\" name=\"todoDelete\">Delete </button>"."</br>";
        }
        // echo '<script>alert("i am in the process!")</script>';

    }
    #<<<<<<<<<<<<>>>>>>>>>>>
    #ADD New Task;dbConnection
    else if(isset($_POST['newToDo'])){
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $userId=$_POST['userId'];
        // $userId=(int)$userId;
        $newTask=$_POST['newTask'];
        $myQuery="INSERT INTO `usertodo` (`userId`, `userTodo`) VALUES (`$userId` , `$newTask`);";
        if(mysqli_query($dbObj->con,$myQuery)){
            echo '<script>alert("We did this!")</script>'; 
        }else{
            echo '<script>alert("unable to do this task!")</script>';
        }
        // echo '<script>alert("i am in the process!")</script>';

    }
}else{
    header("Location:admin.php");
}
?>