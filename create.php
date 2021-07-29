<?php
define('BASEPATH', true);	
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
        $stmt = $pdo_conn->prepare("INSERT INTO staff (first_name, surname, email) 
        VALUES (
                :first_name,:surname,:email
        )");
        $stmt->bindParam(':first_name',$f_name);
        $stmt->bindParam(':surname',$s_name);
        $stmt->bindParam(':email',$email);

        if ($stmt->execute()){
            $message = 'data inserted successfully';
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
    </div>
</div>
<?php include ("footer.php"); ?>