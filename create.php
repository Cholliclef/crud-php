<?php
define('BASEPATH', true);	
require("connect.php");
// $message = '';

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
            // $message = 'data inserted successfully';
            echo '<script>window.location.replace("index.php")</script>';
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

