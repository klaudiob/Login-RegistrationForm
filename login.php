<?php

include 'config_func.php';

if (isUserLoggedIn()) header('Location: logged_in.php');

        $connection = mysqli_connect("localhost","root","","formdb");
        if(!$connection) die("Sorry,unable to connect to the database");

        echo"Connection to the database is done";
        echo"<br>";

        $error_username="";
        $error_password="";

        if(isset($_POST) && !empty($_POST)){
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);

                if(empty($_POST['username'])){
                    $error_username="Username is required!";
                };           
                if(empty($_POST['password']))
                {
                    $error_password="Password is required";
                };
                $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";  
                $result = mysqli_query($connection, $sql);  
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                $count = mysqli_num_rows($result);  
                $password = sha1($password); 
                if($count == 1){ 
                    $_SESSION['login'] = true; 
                    header('Location: http://localhost/project/logged_in.php');  
                }  
                else{  
                    echo '<script>alert("Login failed. Invalid username or password!")</script>';                  
                }  
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="styles.css">

</head>
<body>
        <div class="signup-form ">
                <form action="" method="POST">
                    <h2>Sign In</h2>
                    <p>Please fill in this form to log in!</p>
                    <hr>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                    <span  style="color: red;"> <?php echo $error_username;?></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span  style="color: red;"> <?php echo $error_password;?></span>
                </div>
                    <div class="form-group">
                        <button type="submit" name="next" class="btn btn-primary btn-lg">Next</button>
                    </div>
                </form>
                <div class="hint-text">Don't have an account? <a href="user_details.php">Sign Up</a></div>
            </div>
</body>
</html>