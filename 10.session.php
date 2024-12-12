<?php
//start session
session_start();
echo session_id();
$_SESSION['name'] = 'Sangam Shrestha';
echo $_SESSION['name'];

?>   