<?php
if (isset($_COOKIE['mobile'])) {
    session_start();
    $_SESSION['user'] =$_COOKIE;
    header('location:11.dashboard.php');
}
if (isset($_GET['msg']) && $_GET['msg'] == 1) {
    echo 'Please login to continue';
}
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $error = [];
    if (isset($_POST['mobile']) && !empty($_POST['mobile']) && trim($_POST['mobile'])) {
        $mobile = $_POST['mobile'];
    } else {
        $error['mobile'] = 'Enter mobile number';
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = ($_POST['password']);
    } else {
        $error['password'] = 'Enter password';
    }

    if (count($error) == 0) {
        try{
            //connection
            $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
            //query to select all column from users table
           echo $selectquery = "select * from tbl_users where mobile='$mobile' and password='$password'";
            $result = mysqli_query($connection,$selectquery);
            $users = [];
            if(mysqli_num_rows($result) == 0){
                echo "User not found";
            } else {
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user'] = $user;
                if (isset($_POST['remember'])) {
                    setcookie('mobile',$user['mobile'],time()+(7*24*60*60));
                    setcookie('name',$user['name'],time()+(7*24*60*60));
                    
                }
                // echo "User Login success";
                header('location:11.dashboard.php');
        
            }
            // mysqli_query($connection,$insertsql);
        }catch(Exception $ex){
            echo "Database Error: " . $ex->getMessage();
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            text-align:center;
        }
        fieldset{
            width:50%;
            margin:auto;
        }
        .form-group{
            border:1px solid green;
            margin-bottom:10px;
            padding:10px;
        }

        .form-group label{
            display:inline-block;
            width:100px;
        }

        .form-group input{
            width:50%;
        }

        .form-group input.btn{
            width:10%;
        }
    </style>
</head>
<body>
    <h1>Login Form</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend>Login Form</legend>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" placeholder="mobile" value="<?php echo isset($mobile)?$mobile:''; ?>">
                <?php echo isset($error['mobile'])?$error['mobile']:'' ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" placeholder="password">
                <?php echo isset($error['password'])?$error['password']:'' ?>
            </div>
            <div class="form-group">
                <input type="checkbox" class='btn' name="remember" value="remember" />remember me for 7 days
            </div>
            <div class="form-group">
                <input type="submit" class='btn' name="Login" value="Login" />
                <input type="reset" class='btn' name="reset" value="Clear" />
            </div>
        </fieldset>
    </form>
</body>
</html>