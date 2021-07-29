<?php
// define('BASEPATH', true);	
require("connect.php");
$message = '';

if(isset($_POST['submit'])){
    try{
        $pdo_conn = new PDO( 'mysql:host=localhost;dbname=company', $database_username, $database_password );
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $f_name = $_POST['firstname'];
    $s_name = $_POST['surname'];
    $email = $_POST['email'];

    $sql = "SELECT COUNT(email) AS num FROM staff WHERE email = :email";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(':email',$email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0){
        echo '<script>alert("Email already exists");</script>';
    }else{
        $stmt = $pdo_conn->prepare("update staff set first_name='" . $_POST[ 'first_name' ] . "', surname='" . $_POST[ 'surname' ]. "', email='" . $_POST[ 'email' ]. "' where id=" . $_GET["id"]);
        $stmt->bindParam(':first_name',$f_name);
        $stmt->bindParam(':surname',$s_name);
        $stmt->bindParam(':email',$email);

        if ($stmt->execute()){
            $message = 'Data updated';
        }else{
            $error = "Error: ".$e->getMessage();
            echo '<script>alert("'.$error.'");</script>';
        }
    }
    }catch(PDOException $e){
        $error = "Error: ".$e->getMessage();
        echo '<script>alert("'.$error.'");</script>';
    }
}
$stmt = $pdo_conn->prepare("SELECT * FROM staff where id=" . $_GET["id"]);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<?php include ("header.php"); ?>
<div class="container">
    <div class="card mt-5">
        <div class="card header">
            <a href="index.php" ><h2>Back to all staffs</h2></a>
        </div>
        <div class="card body">
        <?php if(!empty($message)): ?>
        <div class="alert alert-success">
        <?= $message; ?>
        </div>
        <?php endif?>
         <form method="POST">
            <div class="form-group">
                <label for="name">Firstname</label>
                <input type="text" value="<?php echo $result[0]['firstname']; ?>" required class="form-control" name="firstname" id="firstname">
            </div>
            <div class="form-group">
                <label for="name">Surname</label>
                <input type="text" value="<?php echo $result[0]['surname']; ?>" required class="form-control" name="surname" id="surname">
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" value="<?php echo $result[0]['email']; ?>" required class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <button name="submit" type="submit" value="Save" class="btn btn-info">Update</button>
            </div>
         </form>
        </div>
    </div>
</div>
<?php include ("footer.php"); ?>