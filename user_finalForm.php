<?php
        $connection = mysqli_connect("localhost","root","","formdb");
        if(!$connection) die("Sorry,unable to connect to the database");

        echo"Connection to the database is done";
        echo"<br>";

        session_start();

        $error_username="";
        $error_password="";
        
        $errorCheckboxMsg = "";
        $errorConfigPass = "";
        $errorConfirmPassword = "";

        $errorCheckbox =  $_SESSION['checkbox'] = $_POST['checkbox'] ?? false;

        $err_UsedUsername ="";

        if(isset($_POST['register'])) {

                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['confirm_password'] = $_POST['confirm_password'];

                $name = mysqli_real_escape_string($connection,$_SESSION['name']);
                $lastname = mysqli_real_escape_string($connection,$_SESSION['lastname']);
                $email = mysqli_real_escape_string($connection,$_SESSION['email']);
                $birth_date = mysqli_real_escape_string($connection,$_SESSION['birth_date']);
                $address = mysqli_real_escape_string($connection,$_SESSION['address']);
                $zip_code = mysqli_real_escape_string($connection,$_SESSION['zip_code']);
                $city = mysqli_real_escape_string($connection,$_SESSION['city']);
                $country = mysqli_real_escape_string($connection,$_SESSION['country']);
                $username = mysqli_real_escape_string($connection,$_SESSION['username']);
                $password = mysqli_real_escape_string($connection,$_SESSION['password']);
                $confirmpassword =  mysqli_real_escape_string($connection,$_SESSION['confirm_password']);

                $password = sha1($password);
                $confirmpassword = sha1($confirmpassword);

                if(empty($_POST['username'])){
                    $error_username="*Username is required!";
                };
            
                if(empty($_POST['password'])){              
                    $error_password="*Password is required!";
                };

                if(empty($_POST['confirm_password'])){
                    $errorConfirmPassword="*Confirm password is required!";
                };
           
                if($password !== $confirmpassword){
                  $errorConfigPass="*Password does not match!";
                }

                if($errorCheckbox == false){
                    $errorCheckboxMsg = "*This check is required!";
                }

                $sql = "SELECT * FROM users WHERE username = '$username'";  
                $result_username = mysqli_query($connection, $sql);  

                if (mysqli_num_rows($result_username) > 0) {
                    $err_UsedUsername = "*This username is taken!";
                }

                if (!$result_username){
                    echo"Query failed";
                }else{
                   if(mysqli_num_rows($result_username) > 0) {
                       echo $err_UsedUsername;
                   }elseif ($password !== $confirmpassword || $errorCheckboxMsg != "") {
                    echo $errorCheckboxMsg;
                    echo $errorConfigPass;
                   } else {
                    $query = "INSERT INTO users (name,lastname,email,birth_date,address,zip_code,city,country,username,password) VALUES ('".$name."','".$lastname."','".$email."','".$birth_date."','".$address."','".$zip_code."','".$city."','".$country."','".$username."','".$password."')";
                    $result = mysqli_query($connection,$query);
                    if(!$result){
                        echo "error";
                    } else {
                        echo "success";
                    }
                   }
                }
        }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Sign Up</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="styles.css">

</head>
<body>
     <div class="signup-form">
            <form action="" method="POST">
                <h2>Sign Up</h2>
                <p>Please fill in this form to create an account!</p>
                <hr>           
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                    <span  style="color: red;"> <?php echo $error_username;?></span>
                    <span  style="color: red;"> <?php echo $err_UsedUsername;?></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span  style="color: red;"> <?php echo $error_password;?></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                    <span  style="color: red;"> <?php echo $errorConfirmPassword;?></span>
                    <span  style="color: red;"> <?php echo $errorConfigPass;?></span>
                </div>                   
                <div class="form-group">
                    <label class="form-check-label"><input type="checkbox" name="checkbox"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                    <span  style="color: red;"> <?php echo $errorCheckboxMsg;?></span>
                </div>
                <div class="form-group">
                    <label class="form-check-label"><input type="checkbox" name="checkbox_2"> I accept the <a href="#">Marketing purposes</a></label>
                </div>
                <div class="form-group">
                    <button type="submit" name="register" class="btn btn-primary btn-lg">Sign Up</button>
                </div>
            </form>
     </div>
</body>
</html>