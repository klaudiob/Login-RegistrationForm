<?php

        $connection = mysqli_connect("localhost","root","","formdb");
        if(!$connection) die("Sorry,unable to connect to the database");

        echo"Connection to the database is done";
        echo"<br>";

        $error_name="";
        $error_lastname="";
        $error_email="";
        $err_UsedEmail="";

        if(isset($_POST['next'])){

            session_start();
            //store the session data
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['lastname'] = $_POST['lastname'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['birth_date'] = $_POST['birth_date'];

            $email=$_POST['email'];
    
            $emailQueryCheck = "SELECT email FROM users WHERE  email = '".$_SESSION['email']."'";
            $result_email =  mysqli_query($connection, $emailQueryCheck);

            if (mysqli_num_rows($result_email) > 0) {
                $err_UsedEmail = "*This email is taken";
              };

            if(empty($_POST['name'])){
                $error_name="*Name is required!";
            };
        
            if(empty($_POST['lastname']))
            {
                $error_lastname="*Last name is required";
            };
        
             if(empty($_POST['email'])){
                $error_email="*Email address is required";
            };
           
            if(empty($error_name) && empty($error_lastname) && empty($error_email) && empty($err_UsedEmail)){
                header('Location: http://localhost/project/user_address.php');
            };
        }        
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Sign up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" name="name" placeholder="First Name" >
                            <span  style="color: red;"> <?php echo $error_name;?></span>
                        </div>
                        <div class="col"><input type="text" class="form-control" name="lastname" placeholder="Last Name">
                            <span  style="color: red;"> <?php echo $error_lastname;?></span>
                        </div>
                    </div>        	
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <span  style="color: red;"> <?php echo $error_email;?></span>
                    <span  style="color: red;"> <?php echo $err_UsedEmail;?></span>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" name="birth_date" placeholder="Birth-Date">
                </div>
                <div class="form-group">
                    <button type="submit" name="next" class="btn btn-primary btn-lg">Next</button>
                </div>
            </form>
	    <div class="hint-text">Already have an account? <a href="login.php">Login here</a></div>
    </div>
    

</body>
</html>