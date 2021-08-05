<?php
if(isset($_POST['updatedata'])){
    try{
        $pdo_conn = new PDO( 'mysql:host=localhost;dbname=company', $database_username, $database_password );
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id = $_POST['update_id'];

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
        $stmt = $pdo_conn->prepare("UPDATE staff set first_name='" . $_POST[ 'firstname' ] . "', surname='" . $_POST[ 'surname' ]. "', email='" . $_POST[ 'email' ]. "' where id=$id");
        $stmt->bindParam(':first_name',$f_name);
        $stmt->bindParam(':surname',$s_name);
        $stmt->bindParam(':email',$email);

        if ($stmt->execute()){
            echo '<script>window.location.replace("index.php")</script>';

        }else{
            $error = "Error: ".$e->getMessage();
            echo '<script>alert("'.$error.'");</script>';
        }
    }
    }catch(PDOException $e){
        $error = "error: ".$e->getMessage();
        echo '<script>alert("'.$error.'");</script>';
    }
}
?>