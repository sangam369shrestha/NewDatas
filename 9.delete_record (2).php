<?php require '11.check_session.php';?>

<?php
$id = $_GET['id'];
error_reporting(0);
try{
    $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
    $insertsql = "delete from tbl_users where id=$id";
    mysqli_query($connection,$insertsql);
    if(mysqli_affected_rows($connection) == 1){
        header('location:9.select_record.php');
    } else {
        echo "user delete failed";
    }
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
?>