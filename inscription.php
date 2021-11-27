<?php

include('./fileconfig/config.php');

if (isset($_POST['form-sign-up'])) {

    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);
    $confirm_password = sha1($_POST['confirm_password']);

    if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm_password'])) {


        $loginlenght = strlen($login);
        if ($loginlenght >= 2 && $loginlenght <= 18) {
            $getlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $getlogin->execute(array($login));
            $logincount = $getlogin->rowCount();

            if ($logincount == 0) {
                if ($password == $confirm_password) {
                    $inserusers = $bdd->prepare("INSERT INTO utilisateurs ( login, password ) VALUES (?, ?)");
                    $inserusers->execute(array($login, $password ));
                    $reussi = "Vous avez créer votre compte";
                    header('Location: ./connexion.php');
                } else {
                    $erreur = "Vos mots de passe ne sont pas identiques";
                }
            } else {
                $erreur = "Compte deja existant !";
            }
        } else {
            $erreur = "Votre login n'est pas valide";
        }
    } else {
        $erreur = "Veuillez remplir tout les champs !";
    }
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign-in-and-up.css">
    <link rel="shortcut icon" href="./img/fav.png" type="image/png">
    <title>Inscription</title>
</head>

<body>
    <header>
        <h1>Inscription</h1>
    </header>
    <main>
        <form action="" method="POST">
            <div class="container-input">
                <input type="text" name="login" class="login-input" placeholder="Login" value="">
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

            <div class="login-sign-in">
                <p class="login-title">Accéder à votre compte</p>
                <a class="login-go-to-connexion" href="./connexion.php">Connectez-vous</a>
            </div>
        </form>
    </main>
</body>

</html>