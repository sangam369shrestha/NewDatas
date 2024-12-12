<?php
session_start();
session_destroy();
setcookie('mobile',null,time()-1);
setcookie('name',null,time()-1);
header('location:11.login.php');    
?>