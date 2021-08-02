<?php 
define('BASEPATH', true);
require("connect.php");
$result ='';
?>
<?php include ("header.php"); ?>
<div class="container">
<?php	
	$pdo_statement = $pdo_conn->prepare("SELECT * FROM staff ORDER BY id DESC");
	$pdo_statement->execute();
  $result = $pdo_statement->fetchAll();
?>


<!--Add Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="create.php">
              <div class="form-group">
                  <label for="name">Firstname</label>
                  <input type="text" class="form-control" name="firstname" id="firstname">
              </div>
              <div class="form-group">
                  <label for="name">Surname</label>
                  <input type="text" class="form-control" name="surname" id="surname" required>
              </div>
              <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div><button name="submit" type="submit" value="Add" class="btn btn-info">Add</button></div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" Action="edit.php">
              <div class="form-group">
                  <label for="name">Firstname</label>
                  <input type="text" class="form-control" value="<?php echo $result[0]['first_name']; ?>" required name="firstname" id="firstname">
              </div>
              <div class="form-group">
                  <label for="name">Surname</label>
                  <input type="text" class="form-control" value="<?php echo $result[0]['surname']; ?>" required name="surname" id="surname" required>
              </div>
              <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" value="<?php echo $result[0]['email']; ?>" required name="email" id="email" required>
              </div>
              <div><button name="submit" type="submit" value="edit" class="btn btn-info">Update</button></div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Staffs</h2>
            <div class="row">
              <div class="col-md-12 text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add" style="width:100px;">Add</button>
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
                      <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-info" data-toggle="modal" data-target="" style="width:100px;">Edit</a>
                      <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger" style="width:100px;">Delete</a>
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