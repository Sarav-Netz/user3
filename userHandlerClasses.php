<?php
    #this file of php contain all the classes require for the change inside the user intefaces.

    # Class to handle the changes made bu the admin;
    class adminChange{
        public function addNewUser($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("New user is added successfully!")</script>';
            }else{
                echo 'script>alert("we are not able to do this task!")</script>';
            }
        }
        #fuction to show the User Detail
        public function showUser($con,$query){
            $table=mysqli_query($con,$query); #this will fetch the data from database;
            if($table){
                return $table;
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        #Update the User Info;
        public function updateUserInfo($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("Your Information is updated successfully")</script>';
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        # function to update the password;
        public function updateUserPassword($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("Your password is updated successfully")</script>';
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        # function to delete any user by the admin;
        public function deleteAnyUser($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("User deleted Successfully!")</script>';
            }else{
                echo '<script>alert("We are not able to do this task! please try again.")</script>';
            }
        }
        public function showAllUserToAdmin($con,$query){
            $table=mysqli_query($con,$query);
            if($table){
                return $table;
            }else{
                echo 'we are not able to do this task';
            }
        }
        #user approval by the admin;
        public function approveUser($con,$query){
                if(mysqli_query($con,$query)){
            }
        }
        #User Blockage by the Admin
        public function disApproveUser($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("User is approved successfully!")</script>';
            }else{
                echo '<script>alert("We are not able to do this task!")</script>';
            }
        }
    }



    #manage class
    class managerChange{
        public $makeChange;
        public function addNewUser($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("New user is added successfully!")</script>';
            }else{
                echo 'script>alert("we are not able to do this task!")</script>';
            }
        }
        public function allowToChange($con,$query){
            $table=mysqli_query($con,$query);
            $row=$table->fetch_assoc();
            if($row['userRole']!="admin" && $row['userRole']!="manager"){
                $this->makeChange=TRUE;
                return $this->makeChange;
            }else{
                $this->makeChange=FALSE;
                return $this->makeChange;
            }
        }
        public function showUser($con,$query){
            $table=mysqli_query($con,$query);
            if($table){
                return $table;
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        public function updateUserInfo($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("Your Information is updated successfully")</script>';
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        public function updateUserPassword($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("Your password is updated successfully")</script>';
            }else{
                echo '<script>alert("We are not able to do this task")</script>';
            }
        }
        public function deleteAnyUser($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("User deleted Successfully!")</script>';
            }else{
                echo '<script>alert("We are not able to do this task! please try again.")</script>';
            }
        }
        public function showAllUserToManager($con,$query){
            $table=mysqli_query($con,$query);
            if($table){
                return $table;
            }else{
                $table=FALSE;
                return $table;
            }
        }
        public function validateStaff($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("staff Member approved Successfully!")</script>';
            }else{
                echo '<script>alert("We are not able to do this task! please try again.")</script>';
            }
        }
        public function deValidateStaff($con,$query){
            if(mysqli_query($con,$query)){
                echo '<script>alert("staff Member Blocked Successfully!")</script>';
            }else{
                echo '<script>alert("We are not able to do this task! please try again.")</script>';
            }
        }
    }

    //enduser class handler
    class userChange{
        public function showUser($con,$query){
            $table=mysqli_query($con,$query);
            if($table){
                return $table;
                // $row=$table->fetch_assoc();
                // echo "<div class=\"row bg-success text-info text-lg-center\">";
                // echo "<div class=\"col-md-5 card m-auto\"><p class=\"card-header\"> Your Email:";
                // echo $row['userEmail'];
                // echo "</p></div>";
                // echo "<div class=\"col-md-5 card m-auto\"><p class=\"card-header\"> Your Name:";
                // echo $row['userName'];
                // echo "</p></div>";
                // echo "<div class=\"col-md-5 card m-auto\"><p class=\"card-header\"> Your Id:";
                // echo $row['userId'];
                // echo "</p></div>";
                // echo "<div class=\"col-md-5 card m-auto\"><p class=\"card-header\"> Your Role with us:";
                // echo $row['userRole'];
                // echo "</p></div>";
                // echo "</div>"; 
            }else{
                $table=FALSE;
                return $table;
            }
        }
        public function updateUserInfo($con,$query){
            $result = mysqli_query($con,$query);
            return $result;
        }
        public function updateUserPassword($con,$query){
            $result = mysqli_query($con,$query);
            return $result;
        }
    }

?>
