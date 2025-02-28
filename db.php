<?php
$dsn = 'sqlite:src/database.sqlite';
$pdo = new PDO($dsn);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

require 'src/utils.php';
$utils = new Utility();

$stmt = $pdo->prepare("UPDATE lojas SET role='admin', senha='".md5('semprelivre')."' WHERE nome='admin'");
$stmt->execute();
?>
