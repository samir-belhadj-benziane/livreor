<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

// $bdd = new PDO('mysql:host=localhost:3306;dbname=samir-belhadj-benziane_livreor', 'samir-belhadj', 'benziane13015');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>