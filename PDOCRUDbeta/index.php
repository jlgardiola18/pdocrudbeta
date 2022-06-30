<?php 

session_start();

try {
    require_once("dbconfig.php");
    if(isset($_POST['login'])){

        if(empty($_POST['username']) || empty($_POST['password'])){
            $message = "All fields are required";
        }else{
            $sql = "SELECT * FROM tbladmin WHERE username =:username AND password =:password";
            $userrow=$dbh->prepare($sql);
            $userrow->execute(
                array(
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                )
            );
            $count = $userrow->rowCount();
            if($count > 0 ){
                foreach($userrow as $result);
                $_SESSION['userid'] = $result['ID'];
                header('location: dashboard.php');
            }else{
                $message = "Wrong Username or Password!";
            }
        }

    }
}catch(\Throwable $error){
    $message->$error->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" href="stylesheet">
    
</head>
<body style="background:#eee">

    <div class="container" style="width:30%">
        <h3>Admin Login</h3>
        <form method="POST">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" Required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" Required>
            </div>

            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
            
        </form>

        <?php
        if(isset($message)){
            echo '<div class="alert alert-danger">'.$message.'</div>';
        }
        ?>
        
    </div>

    
</body>
</html>