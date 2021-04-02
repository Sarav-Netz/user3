<?php
    session_start();
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
    <title>ManagerDashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand font-weight-bold text-light" href="managerInterface.php">Groot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-dark"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link font-weight-bold text-warning" href="managerInterface.php?addNewUser=true">Add New Member <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link font-weight-bold text-light" href="managerInterface.php?showAllMember=true">Show All End User</a>
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
                                <a class='nav-link font-weight-bold text-white float-right ' href='managerInterface.php?showMyDetailClick=true'>$row[userName]</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link font-weight-bold text-warning' href='logOut.php?logout=true'>Log Out</a>
                            </li>
                        " ;
                }
            ?>
          
        </div>
    </nav>
    <div class="container">
        <div>
            <?php
            if($validMember){
                #---------->>>>>>>>>>>>>>>>><<<<<<<<<<<<---------
                # Condition to show members;
                if(isset($_GET['showAllMember'])){
                    echo "<table class=\"table\">
                    <thead>
                        <tr>
                            <th scope=\"col\">SR. no.</th>
                            <th scope=\"col\">USER Id</th>
                            <th scope=\"col\">User Name</th>
                            <th scope=\"col\">User Email</th>
                            <th scope=\"col\">User Role</th>
                            <th scope=\"col\">User Approval</th>
                            <th scope=\"col\">User Modification</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $dbObj=new dbConnection();
                    $queryObj=new createQuery();
                    $userObj=new managerChange();
                    $dbObj->connectDb();
                    $queryObj->selectAllUserQuery();                    
                    $table=$userObj->showAllUserToManager($dbObj->con,$queryObj->myQuery);
                    $dbObj->dissconnectDb();
                    if($table){
                        $srNo=0;
                        while($row=$table->fetch_assoc()){
                            if($row['userRole']!='admin'&& $row['userRole']!='manager'){
                                $srNo+=1;
                                echo "<tr>
                                <td>".$srNo."</td>
                                <td>".$row['userId']."</td>
                                <td>".$row['userName']."</td>
                                <td>".$row['userEmail']."</td>
                                <td>".$row['userRole']."</td>
                                <td>".$row['valid']."</td>
                                <td>"
                                    ."<a href=managerInterface.php?editMe=true class='link'> Edit </a>|".
                                    "<a href=managerInterface.php?valid=true> Validate</a>|".
                                    "<a href=deleteUser.php onclick='getInfo()'> Delete</a>".
                                "</td>"
                                ."</tr>";
                            }
                        }
                    }
                    echo "</tbody>
                    </table>";
                }else if(isset($_GET['addNewUser'])){
                    include("addnew.php");
                }
                #>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<-----------
                #show my detail
                elseif(isset($_GET['showMyDetailClick'])){
                    $userId=(int)$_SESSION['userId'];
                    $dbObj=new dbConnection();
                    $dbObj->connectDb();
                    $queryObj=new createQuery();
                    $queryObj->selectWithCond($userId);
                    $userObj=new managerChange();
                    $table=$userObj->showUser($dbObj->con,$queryObj->myQuery);
                    $dbObj->dissconnectDb();
                    if($table){
                        $row=$table->fetch_assoc();
                        echo "<div class='card text-white bg-info mb-3 mt-5' style='max-width:;'>
                        <div class='card-header'>$row[userName] Information</div>
                        <div class='card-body'>
                        <h5 class='card-title mb-2 ml-3'>User Id: ".$row['userId']."</h5>
                        <h5 class='card-title mb-2 ml-3'>user Name: ".$row['userName']."</h5>
                        <h5 class='card-title mb-2 ml-3'>user Email: ".$row['userEmail']."</h5>
                        <h5 class='card-title mb-2 ml-3'>user Role: ".$row['userRole']."</h5>
                        <h5 class='card-title mb-2 ml-3'>user is Valid: ".$row['valid']."</h5>
                        </div>
                    </div>
                    <button class='btn'> <a href=managerInterface.php?editMe=true> Edit</a> </button>";
                    }
                }elseif(isset($_GET['editMe'])){
                    include('editUser.php');
                }elseif(isset($_GET['valid'])){
                    include('validateUser.php');
                }else{
                    echo "<div class='jumbotron jumbotron-fluid'>
                    <div class='container'>
                      <h1 class='display-4'>Fluid jumbotron</h1>
                      <p 
                        class='lead'>This is a modified jumbotron that occupies the entire horizontal space of its parent.
                        
                            What is Lorem Ipsum?
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            Why do we use it?
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

                      </p>
                    </div>
                  </div>";
                }
            }
            ?>    
        </div>
        <div class="container">

        </div>
    </div>
    <script>
        function editFun(){
            window.location='editUser.php';
        }
    </script>
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