<?php
//print_r($_POST);
$success=false;
$wrongPass=false;
$error=false;
$exist=false;

if(($_SERVER["REQUEST_METHOD"]=="POST")){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "register_form";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password,$database);
   

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    

    // Collect post variables
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $confirmPassword=password_hash($_POST['confirmPassword'],PASSWORD_DEFAULT);

    //here we will retrive username entered by user to check if the username is already in use 
    $sql="Select * from register_table where username='$username'";
    
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    
     // to check whether the given query has any row affected 

    if($_POST['confirmPassword']!=$_POST['password']){
        echo "Check the password again";
        $error=true;
    }

    if($num==0 && $error!=true){
           // CREATE TABLE `register_form`.`register_table` ( `name` VARCHAR(1000) NOT NULL , `username` VARCHAR(1000) NOT NULL , `password` VARCHAR(1000) NOT NULL , `phone` INT(1000) NOT NULL , PRIMARY KEY (`username`)) ENGINE = InnoDB;
                $sql = "INSERT INTO `register_table` (`name`,`email`, `username`,`password`,`phone`) VALUES ('$name','$email','$username', '$password','$phone')";
                // Check if the query is executed
                if($con->query($sql) == true){
        
                     $success =true;
                }
                else{
                    echo "ERROR: $sql <br> $con->error";
                }
        }else if($num>0){
            $exist=true;
        }
        // Close the database connection
        $con->close();
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="Form.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Form Reg</title>
</head>
<body>
<?php
    if($success){ 
        
            echo ' <div class="alert alert-success  
                alert-dismissible fade show" role="alert"> 
        
                <strong>Success!</strong> Thank you for registering with us.  
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close">  
                    <span aria-hidden="true">×</span>  
                </button>  
            </div> ';  
        } 
        
        if($error){ 
        
            echo ' <div class="alert alert-danger  
                alert-dismissible fade show" role="alert">  
            <strong>Error!</strong>Check the confirm Password,it doesnt match
        
        <button type="button" class="close" 
                data-dismiss="alert aria-label="Close"> 
                <span aria-hidden="true">×</span>  
        </button>  
        </div> ';  
    } 
            
        if($exist){ 
            echo ' <div class="alert alert-danger  
                alert-dismissible fade show" role="alert"> 
        
            <strong>Error!</strong>Username already exists
            <button type="button" class="close" 
                data-dismiss="alert" aria-label="Close">  
                <span aria-hidden="true">×</span>  
            </button> 
        </div> ';  
        } 
     
?> 





<div class="container">
        <h1> Registration form</h1>
        <p>Please enter below the required details and click the submit button</p>
        <form method="post" action="Form.php">
            <div class="form-group row ">
                <label for="Oem " class="col-sm-2 col-form-label ">NAME</label>
                <div class="col-sm-10 ">
                    <input type="text" class="form-control " id="name" name="name" placeholder="Enter the name" required>
                    <label id="nameCheck" class="error"></label>
                </div>
            </div>
            <div class="form-group row ">
                <label for="userName" class="col-sm-2 col-form-label ">USERNAME</label>
                <div class="col-sm-10 ">
                    <input type="text" class="form-control " id="userName" name="username" placeholder="Enter the username" required>
                    <label id="userNameCheck" class="error"></label>
                </div>
            </div>
             <div class="form-group row ">
                <label for="email" class="col-sm-2 col-form-label ">EMAIL</label>
                <div class="col-sm-10 ">
                    <input type="email" class="form-control " id="userName" name="email" placeholder="Enter the email" required>
                    <label id="userNameCheck" class="error"></label>
                </div>
            </div>
             <div class="form-group row ">
                <label for="userName" class="col-sm-2 col-form-label ">PASSWORD</label>
                <div class="col-sm-10 ">
                    <input type="password" class="form-control " id="password" name="password" placeholder="Enter the password" required>
                    <label id="passwordCheck" class="error"></label>
                </div>
            </div>
            <div class="form-group row ">
                <label for="userName" class="col-sm-2 col-form-label ">CONFIRM PASSWORD</label>
                <div class="col-sm-10 ">
                    <input type="password" class="form-control " id="password" name="confirmPassword" placeholder="Enter the password" required>
                    <label id="passwordCheck" class="error"></label>
                </div>
            </div>
            <div class="form-group row ">
                <label for="phoneNum" class="col-sm-2 col-form-label ">PHONE NUMBER</label>
                <div class="col-sm-10 ">
                    <input type="number" class="form-control " id="phoneNum" name="phone" placeholder="Enter the phone number" required>
                    <label id="phoneNumCheck" class="error"></label>
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-sm-10 col text-center ">
                    <button type="submit" class="btn btn-primary btn-lg ">Submit</button>
                </div>
            </div>
        </form>

    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>