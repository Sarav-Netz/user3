<?php
     if(!$_SESSION['userRole']){
        header("Location:admin.php");
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand font-weight-bold text-light" href="admin.php">Groot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-dark"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link font-weight-bold text-warning" href="adminInterface.php" data-toggle="modal" data-target="#addUserModal" onclick="newmember()">Add New Member<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link font-weight-bold text-light" href="adminInterface.php?showAllMember=true" id="showAllMemberToAdmin" onclick="showAllMember()">Show All Member</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold text-light" href="toDo.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    TASK
                    </a>
                    <div class="dropdown-menu bg-dark " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item font-weight-bold text-light" href="toDo.php?myTask=true">My Task</a>
                    <a class="dropdown-item font-weight-bold text-light" href="toDo.php?addTask=true">ADD Task</a>
                    <!-- <div class="dropdown-divider"></div> -->
                    </div>
                </li>
            </ul>
            <?php
                if($validMember){
                    $userId=(int)$_SESSION['userId'];
                    $dbObj=new dbConnection();
                    $dbObj->connectDb();
                    $queryObj=new createQuery();
                    $queryObj->selectWithCond($userId);
                    $userObj=new adminChange();
                    $table = $userObj->showUser($dbObj->con,$queryObj->myQuery);
                    $dbObj->dissconnectDb();
                    $row=$table->fetch_assoc();
                    echo "<ul class='nav navbar-nav navbar-right'>
                            <li class='nav-item'>
                                <a class='nav-link font-weight-bold text-white float-right ' href='userInfo.php'>$row[userName]</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link font-weight-bold text-warning' href='logOut.php?logout=true'>Log Out</a>
                            </li>
                        " ;
                }
            ?>
          
        </div>
    </nav>
</body>
</html>
