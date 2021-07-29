<?php
require("connect.php");
$stmt=$pdo_conn->prepare("delete from staff where id=" . $_GET['id']);
$stmt->execute();
echo '<script>window.location.replace("index.php")</script>';
?>