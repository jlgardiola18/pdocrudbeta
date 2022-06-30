<?php 

    require_once("dbconfig.php");

    if(isset($_POST['upload'])){

        $userid = intval($_GET['id']);

        $file_name = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $location="upload/".$file_name;
        
        if($file_size < 524880){
            if(move_uploaded_file($file_temp,$location)){
                try{
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE tblusers SET photo='$location' WHERE ID='$userid'";
                    $dbh->exec($sql);
                }catch(PDOEexception $e){
                    echo $e->getMessage();
                }
                $dbh = null;
                header('location:dashboard.php');
            }
        }else{
            echo "<script>alert('File size is too large to upload!');</script>";
        }

    }

?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>PHP CRUD Operation using PDO Extension</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>

    <?php

        $userid=intval($_GET['id']);
        $sql = "SELECT * FROM tblusers WHERE ID = '$userid'";
        $query=$dbh->prepare($sql);
        $query->execute();
        $result = $query->fetch();

    ?>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3>Profile Upload</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload Here</label>
                        <Input type="file" name="file" class="form-control" required></Input>
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                </form>
            </div>

        </div>
    </div>



</body>
</html>