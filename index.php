<?php 
define('BASEPATH', true);
require("connect.php");
$result ='';
?>
<?php include ("header.php"); ?>
<div class="container">




<!--Add Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Profile</h5>
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

<!-- ############################################################################################################ -->
<!--Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="edit.php">
              <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                  <label for="name">Firstname</label>
                  <input type="text" class="form-control" name="firstname" id="first_name">
              </div>
              <div class="form-group">
                  <label for="name">Surname</label>
                  <input type="text" class="form-control" name="surname" id="sur_name" required>
              </div>
              <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="e_mail" required>
              </div>
              <div><button name="updatedata" type="submit" value="Edit" class="btn btn-info">Update</button></div>
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
        <?php	
          $pdo_statement = $pdo_conn->prepare("SELECT * FROM staff ORDER BY id DESC");
          $pdo_statement->execute();
          $info = $pdo_statement->fetchAll();
        ?>
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
                if($info) { 
                    foreach($info as $row) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["first_name"]; ?></td>
                    <td><?php echo $row["surname"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                      <button type="button" class="btn btn-info editbtn" data-toggle="modal" data-target="#edit" style="width:100px;">Edit</button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add" style="width:100px;">Delete</button>
                    </td>
                </tr>
                <?php
                    }
                }
                else {
                    echo "no result found";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include ("footer.php"); ?>