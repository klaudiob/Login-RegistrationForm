<?php
include 'config_func.php';
if ( logout()) {
    header('Location: http://localhost/project/logged_in.php');
}
?>