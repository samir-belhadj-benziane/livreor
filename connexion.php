<?php

include('./fileconfig/config.php');

if (isset($_POST['form-sign-in'])) {

    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);

    if (!empty($login) and !empty($password)) {
        $requsers = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $requsers->execute(array($login, $password));
        $usersexist = $requsers->rowCount();

        if ($usersexist == 1) {
            $usersinfo = $requsers->fetch();

            $_SESSION['id'] = $usersinfo['id'];
            
            header("Location: ./main.php");
        } else {
            $erreur = "Compte Introuvable";
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
    <link rel="stylesheet" href="./css/inscription.css">
    <link rel="shortcut icon" href="./img/fav.png" type="image/png">
    <title>Connexion</title>
</head>

<body>
    <header>
        <h1>Connexion</h1>
    </header>
    <main>
        <form action="" method="POST" id="form-co">
            <div class="container-input">
                <input type="mail" name="login" class="login-input" placeholder="Login" value="">
            </div>
            <div class="container-input">
                <input type="password" name="password" class="login-input" placeholder="Mot de Passe">
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
                <button type="submit" name="form-sign-in" class="login-submit">
                    <h3>Connexion</h3>
                </button>
            </div>

            <div class="login-sign-up">
                <p class="login-title">Créer votre compte</p>
                <a class="login-go-to-inscription" href="./inscription.php">Inscrivez-vous</a>
            </div>
        </form>
    </main>
</body>

</html>