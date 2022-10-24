<?php

function isUserLoggedIn(){
 return $_SESSION['login'] ?? false;
}

function logout(){
    unset($_SESSION['login']);
    header('Location: http://localhost/project/login.php');  
}
?>