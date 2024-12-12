<?php require '11.check_session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        h1{
            text-align:center;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    
    <p>Welcome <?php echo $_SESSION['user']['name'] ?>, to your dashboard</p>
   <a href="11.logout.php">Logout</a>
   <h1>Hello</h1>
</body>
</html>