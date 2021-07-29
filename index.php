<?php 
define('BASEPATH', true);
require("connect.php");
?>
<?php include ("header.php"); ?>
<div class="container">
<?php	
	$pdo_statement = $pdo_conn->prepare("SELECT * FROM staff ORDER BY id DESC");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Staffs</h2>
            <div>
                <a href="create.php" class="button_link" title="Add New Record" style="vertical-align:bottom;">Create</a>
            </div>         
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                if(!empty($result)) { 
                    foreach($result as $row) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["first_name"]; ?></td>
                    <td><?php echo $row["surname"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                    <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
                    <a href="delete.php?id=<?= $person->id ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include ("footer.php"); ?>