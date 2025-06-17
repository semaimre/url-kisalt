<?php
$dsn = 'mysql:host=localhost;dbname=urlshortener;charset=utf8';
$user = 'root';
$pass = '';
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$pdo = new PDO($dsn, $user, $pass, $options);
?>