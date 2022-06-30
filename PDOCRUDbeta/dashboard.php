<?php 

    
    require_once("dbconfig.php");

    if(isset($_REQUEST['del'])){

        $uid = intval($_GET['del']);
        $sql = "DELETE FROM tblusers WHERE ID=:id";
        $query=$dbh->prepare($sql);

        $query->bindParam(':id',$uid,PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Record Deleted Successfully!');</script>";
        echo "<script>window.location.href='dashboard.php'</script>";

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>PHP CRUD Operation using PDO Extension</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" href="stylesheet">
    
</head>
<body>

    <div class="container">
        
    <!-- <nav class="navbar navbar-default">
        <div class="container-fluid">
            
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">CRUD Management</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="insert.php">Add New Record<span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav> -->

        <div class="row">

            <div class="col-md-12">
                <h3>PHP CRUD Operation using PDO Extension</h3> <hr />
                <a href="insert.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New Record</a>
                <br>
                <br>
                <div class="table-responsive">

                <table id="example" class="table table-bordered table-striped">
                   
                    <thead>
                        
                        <th>#</th>
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Posting Date</th>
                        <th>Tools</th>
                        
                    </thead>

                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM tblusers";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);

                            $cnt=1;
                            if($query->rowCount() > 0){
                                foreach($results as $result)
                            {
                        ?>

                            <tr>
                                <td><?php echo htmlentities($cnt);?></td>
                                <td><img src="<?php echo htmlentities(!empty($result->photo))? ' ' .htmlentities($result->photo): 'upload/default.png';?>" class="img-circle" width="50" height="50"></td>
                                <td><?php echo htmlentities($result->first_name);?></td>
                                <td><?php echo htmlentities($result->last_name);?></td>
                                <td><?php echo htmlentities($result->email);?></td>
                                <td><?php echo htmlentities($result->contact_number);?></td>
                                <td><?php echo htmlentities($result->address);?></td>
                                <td><?php echo htmlentities($result->posting_date);?></td>
                                <td>
                                    <a href="profile.php?id=<?php echo htmlentities($result->ID);?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-picture"></span></a>
                                    <a href="update.php?id=<?php echo htmlentities($result->ID);?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="dashboard.php?del=<?php echo htmlentities($result->ID);?>" class="btn btn-danger btn-sm" onClick="return confirm('Do you really want to delete?')"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>

                        <?php 
                        $cnt++;
                            }}
                        ?>
                    </tbody>

                </table>

            </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>

</body>
</html>