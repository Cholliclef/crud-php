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
                <a href="create.php" type="button" class="btn btn-primary" title="Add New Record" style="vertical-align:bottom;">Create</a>
            </div>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
example
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
        <?= $message; ?>
        </div>
        <?php endif?>
         <form method="POST">
            <div class="form-group">
                <label for="name">Firstname</label>
                <input type="text" class="form-control" name="firstname" id="firstname" required>
            </div>
            <div class="form-group">
                <label for="name">Surname</label>
                <input type="text" class="form-control" name="surname" id="surname" required>
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" value="Create" class="btn btn-info">Create a profile</button>
            </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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