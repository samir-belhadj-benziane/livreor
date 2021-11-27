<?php

$getid = $_SESSION['id'];
$requsers = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ? ');
$requsers->execute(array($getid));
$usersexist = $requsers->rowCount();
$usersinfo = $requsers->fetch();

?>
