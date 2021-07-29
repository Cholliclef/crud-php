<?php
    // defined('BASEPATH') OR exit('No direct script access allowed');
	$database_username = 'root';
	$database_password = '';
    $pdo_conn = new PDO( 'mysql:host=localhost;dbname=company', $database_username, $database_password );
?>