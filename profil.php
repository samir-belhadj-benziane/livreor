<?php

include('./fileconfig/config.php');

if (isset($_POST['form-sign-up'])) {

    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);
    $confirm_password = sha1($_POST['confirm_password']);

    if (!empty($_POST['prenom'])) {
        $prenomlenght = strlen($prenom);
        if ($prenomlenght >= 2 && $prenomlenght <= 18) {
            $inserprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
            $inserprenom->execute(array($prenom, $_SESSION['id']));
            $reussi = "Vous avez modifié votre prenom";
        } else {
            $erreur = "Votre prenom doit contenir 2 a 18 caractères !";
        }
    }

    if (!empty($_POST['nom'])) {
        $nomlenght = strlen($nom);
        if ($nomlenght >= 2 && $nomlenght <= 18) {
            $insernom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
            $insernom->execute(array($nom, $_SESSION['id']));
            $reussi = "Vous avez modifié votre nom";
        } else {
            $erreur = "Votre nom doit contenir 2 a 18 caractères !";
        }
    }

    if (!empty($_POST['login'])) {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $reqmail->execute(array($login));
            $mailexist = $reqmail->rowCount();
            if ($mailexist == 0) {
                $inserlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
                $inserlogin->execute(array($login, $_SESSION['id']));
                $reussi = "Vous avez modifié votre mail";
            } else {
                $erreur = "Adresse mail est deja éxistante !";
            }
        } else {
            $erreur = "Votre Adresse Mail n'est pas valide";
        }
    }

    if (!empty($_POST['password']) and !empty($_POST['confirm_password'])) {
        if ($password == $confirm_password) {
            $inserpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $inserpassword->execute(array($password, $_SESSION['id']));
            $reussi = "Vous avez modifié votre mots de passe";
        } else {
            $erreur = "Vos mots de passe ne sont pas identiques";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/inscription.css">
    <link rel="shortcut icon" type="image/png" href="" />
    <title>Édition du compte</title>
</head>

<body>
    <header>
        <h1 onclick="gotoindex();">Éditer le compte</h1>
    </header>
    <main>
        <form action="" method="POST">
            <div class="container-input">
                <input type="text" name="prenom" class="login-input" placeholder="Prenom" value="">
            </div>
            <div class="container-input">
                <input type="text" name="nom" class="login-input" placeholder="Nom" value="">
            </div>
            <div class="container-input">
                <input type="mail" name="login" class="login-input" placeholder="E-mail" value="">
            </div>
            <div class="container-input">
                <input type="password" name="password" class="login-input" placeholder="Mot de Passe">
            </div>
            <div class="container-input">
                <input type="password" name="confirm_password" class="login-input" placeholder="Retapez le Mot de Passe">
            </div>

            <?php
            if (isset($erreur)) { ?>

                <p class="error" style="font-family: Arial, Helvetica, sans-serif;color: red;"><?php echo $erreur; ?></p>
            <?php
            } elseif (isset($reussi)) { ?>
                <p class="verygut" style="font-family: Arial, Helvetica, sans-serif;color: green;"><?php echo  $reussi; ?></p>
            <?php
            }
            ?>

            <div class="container-input">
                <button type="submit" name="form-sign-up" class="login-submit">
                    <h3>Envoyer</h3>
                </button>
            </div>
        </form>
    </main>
</body>

<script src="./js/goto.js"></script>

</html>