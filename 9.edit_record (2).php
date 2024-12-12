<?php require '11.check_session.php';?>

<?php
$id = $_GET['id'];
//check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* start of form validation*/
    $error = [];
    //check name
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error['name'] = 'Enter name';
    }
    //check gender
     if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error['gender'] = 'Select gender';
    }

    //check dob
    if (isset($_POST['dob']) && !empty($_POST['dob']) && trim($_POST['dob'])) {
        $dob = $_POST['dob'];
    } else {
        $error['dob'] = 'Enter dob';
    }

    //check country
    if (isset($_POST['country']) && !empty($_POST['country']) && trim($_POST['country'])) {
        $country = $_POST['country'];
    } else {
        $error['country'] = 'Enter country';
    }

    //check address
    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $error['address'] = 'Enter address';
    }


    //check mobile
    if (isset($_POST['mobile']) && !empty($_POST['mobile']) && trim($_POST['mobile'])) {
        $mobile = $_POST['mobile'];
    } else {
        $error['mobile'] = 'Enter mobile';
    }

    //check password
    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = md5($_POST['password']) ;
    } else {
        $error['password'] = 'Enter password';
    }
    /*End of form validation*/

    if(count($error) == 0){
        //database query start
        try{
            $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
            $insertsql = "update tbl_users set name='$name',gender='$gender',dob='$dob',country='$country',address='$address',mobile='$mobile',password='$password' where id='$id'";
            mysqli_query($connection,$insertsql);
            if($connection->affected_rows== 1 ){
                echo 'Record update success';
            } else {
                echo "Record Insert Failed";
            }
        }catch(Exception $ex){
            echo "Database Error: " . $ex->getMessage();
        }
        //database query end
    }
}
?>
<?php
error_reporting(0);
try{
    $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
    $insertsql = "select * from tbl_users where id=$id";
    $result = mysqli_query($connection,$insertsql);
    if(mysqli_num_rows($result) == 1){
        $record = mysqli_fetch_assoc($result);
       
        /*$name = $record['name'];
        $dob = $record['dob'];*/
        extract($record);

    } else {
        die('Record not found');
    }
   
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Data</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <h1>Update Data</h1>
    <nav>
    <?php require "9.menu.php"; ?>
    </nav>
    <!-- Form design -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post">
        <fieldset>
            <legend>Registration Details</legend>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="<?php echo isset($name)?$name:''; ?>">
                <span class="error"><?php echo isset($error['name'])?$error['name']:''; ?></span>
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <input type="radio" name="gender" value="male" <?php echo ($gender == 'male')?'checked':'' ?> >Male
                <input type="radio" name="gender" value="female" <?php echo ($gender == 'female')?'checked':'' ?>>Female
                <span class="error"><?php echo isset($error['gender'])?$error['gender']:''; ?></span>
            </div>
            <div class="form-group">
                <label for="">DOB</label>
                <input type="text" name="dob" value="<?php echo isset($dob)?$dob:''; ?>" >
                <span class="error"><?php echo isset($error['dob'])?$error['dob']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Country</label>
                <select name="country" id="country">
                    <option value="">Select country</option>
                    <option value="Nepal" <?php echo ($country == 'Nepal')?'selected':'' ?>>Nepal</option>
                    <option value="India" <?php echo ($country == 'India')?'selected':'' ?>>India</option>
                    <option value="China" <?php echo ($country == 'China')?'selected':'' ?>>China</option>                    
                </select>
                <span class="error"><?php echo isset($error['country'])?$error['country']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address">
                <span class="error"><?php echo isset($error['address'])?$error['address']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Mobile</label>
                <input type="text" name="mobile">
                <span class="error"><?php echo isset($error['mobile'])?$error['mobile']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo isset($error['password'])?$error['password']:''; ?></span>

            </div>
            <div class="form-group">
                <input type="submit" name="register" value="Update">
            </div>
            
        </fieldset>
    </form>
</body>
</html>