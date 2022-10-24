<?php

        session_start();

        $error_address="";
        $error_city="";
        
        if(isset($_POST['next'])){
            //store the session data
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['zip_code'] = $_POST['zip_code'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['country'] = $_POST['country'];
            print_r($_SESSION);

            if(empty($_POST['address'])){
                $error_address="*Address is required!";
            };
        
            if(empty($_POST['city']))
            {
                $error_city="*City is required";
            };
            if(empty($error_address) && empty($error_city)){
              
                header('Location:http://localhost/project/user_finalForm.php');       
            }
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Sign up</title>
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
                <input type="text" class="form-control" name="address" placeholder="Address">
                <span  style="color: red;"> <?php echo $error_address;?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="zip_code" placeholder="Zip-Code">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control" name="city" placeholder="City">
                    <span  style="color: red;"> <?php echo $error_city;?></span>
                </div>
                    <div class="col"><input type="text" class="form-control" name="country" placeholder="Country"></div>
                </div>        	
            </div>  
            <div class="form-group">
                <button type="submit" name="next" class="btn btn-primary btn-lg">Next</button>
            </div>
        </form>
    </div>

</body>
</html>