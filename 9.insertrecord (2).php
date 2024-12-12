<pre>
<?php
error_reporting(0);
try{
    $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
    $insertsql = "insert into tbl_users(name,gender,dob,country,address,mobile,password) 
    values ('Rajesh Dai','Male','2050-03-25','Nepal','Newbazar',98545454555,'heeeyyy')";
    mysqli_query($connection,$insertsql);
    print_r($connection);
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
//object oriented
/*try{
    $connection = new mysqli('localhost','root','','db_pmc_2079_web');
    $insertsql = "insert into tbl_users(name,gender,dob,country,address,mobile,password) 
    values ('Rajesh Dai','Male','2050-03-25','Nepal','Newbazar',98545454555,'heeeyyy')";
    $connection->query($insertsql);
    print_r($connection);
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}*/

?>