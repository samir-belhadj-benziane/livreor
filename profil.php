<?php

include('./fileconfig/config.php');

if (isset($_SESSION['id'])) {

    if (isset($_POST['form-sign-up'])) {

        $login = htmlspecialchars($_POST['login']);
        $password = sha1($_POST['password']);

        if (!empty($_POST['login'])) {
            $loginlenght = strlen($login);
            if ($loginlenght >= 2 && $loginlenght <= 18) {
                $getlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                $getlogin->execute(array($login));
                $logincount = $getlogin->rowCount();
                if ($logincount == 0) {
                    $inserlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
                    $inserlogin->execute(array($login, $_SESSION['id']));
                    $reussi = "Vous avez modifié votre mail";
                } else {
                    $erreur = "Login deja éxistante !";
                }
            } else {
                $erreur = "Votre Adresse Mail n'est pas valide";
            }
        }

        if (!empty($_POST['password'])) {
            if ($password == $confirm_password) {
                $inserpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
                $inserpassword->execute(array($password, $_SESSION['id']));
                $reussi = "Vous avez modifié votre mots de passe";
            } else {
                $erreur = "Vos mots de passe ne sont pas identiques";
            }
        }
    }

    if (isset($_POST['golivreor'])) {
        header('Location: ./livre-or.php');
    }

?>

    <!DOCTYPE html>
    <html lang="fr-FR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/sign-in-and-up.css">
        <link rel="shortcut icon" href="./img/fav.png" type="image/png">
        <title>Édition du compte</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="./img/golden-book.png" alt="">
                <h2>Golden Book</h2>
            </div>
            <nav>
                <form action="" method="post" class="formgoto">
                    <button type="submit" name="golivreor">
                        <h2 title="Livre d'or">Livre d'or</h2>
                    </button>
                </form>
            </nav>
        </header>
        <main>
            <form action="" method="POST">
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
                    <button type="submit" name="form-sign-up" class="login-submit">
                        <h3>Envoyer</h3>
                    </button>
                </div>
            </form>
        </main>
    </body>

    </html>

<?php
} else {
    header('Location: ./index.php');
}
?>