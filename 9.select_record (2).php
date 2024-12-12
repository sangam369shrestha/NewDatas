    <?php require '11.check_session.php';?>

<!-- <pre> -->
<?php
// error_reporting(0);
try{
    //connection
    $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
    //query to select all column from users table
    $selectquery = "select id,name,mobile from tbl_users order by name desc";
    $result = mysqli_query($connection,$selectquery);
    $users = [];
    if(mysqli_num_rows($result) == 0){
        echo "Record not found";
    } else {
        //fetch data from database : assoc,row,array,object
        while ($user = mysqli_fetch_assoc($result)) {
            array_push($users,$user); 
        }
        // mysqli_fetch_row();
        // mysqli_fetch_array();
        // mysqli_fetch_object();

    }
    // mysqli_query($connection,$insertsql);
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List of Users</h1>
    <nav>
        <?php require "9.menu.php"; ?>
    </nav>
    <table border="2">
        <tr>
            <th>SN</th>
            <th>Id</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>
        <?php foreach($users as $index => $user){ ?>
            <tr>
                <td><?php echo $index+1 ?></td>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['mobile'] ?></td>
                <td>
                    <a href="9.delete_record.php?id=<?php echo $user['id'] ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                    <a href="9.edit_record.php?id=<?php echo $user['id'] ?>" onclick="return confirm('Are you sure to edit?')">Edit</a>
                </td>
            </tr>
        <?php } ?>

    </table>
</body>
</html>