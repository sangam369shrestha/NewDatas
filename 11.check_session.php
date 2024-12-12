<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:11.login.php?msg=1');
}
?>