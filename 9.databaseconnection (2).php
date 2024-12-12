<pre>
<?php
//different database connection pattern for mysql using PHP
/*
mysql driver- not working, mysqli(structural, object oriented),
PDO(PHP Data Object- object oriented) : 
*/

// mysqli_connect('database host','database username','database password',[database name]);
//structural
error_reporting(0);
try{
    $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
//object oriented
try{
    $connection = new mysqli('localhost','root','','db_pmc_2079_web');
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
?>