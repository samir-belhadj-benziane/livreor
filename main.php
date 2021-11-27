<?php

include('./fileconfig/config.php');

if (isset($_SESSION['id'])) {

    include('./fileconfig/configusers.php');

    if ($usersinfo['admin'] == 0) {
        $admin = "Non-Admin";
    } elseif ($usersinfo['admin'] == 1) {
        $admin = "Admin";
    }

    if (isset($_POST['disconected'])) {
        session_destroy();
        header('Location: ./index.php');
    }

    if (isset($_POST['edit-account'])) {
        header('Location: ./profil.php');
    }

    if (isset($_POST['space-admin'])) {
        header('Location: ./admin.php');
    }


    if (isset($_POST['golden-book'])) {
        header('Location: ./livre-or.php');
    }

    if (isset($_POST['delete-account'])) {
        $suppr_id = htmlspecialchars($_SESSION['id']);
        $suppr = $bdd->prepare('DELETE FROM utilisateurs WHERE id = ?');
        $suppr->execute(array($suppr_id));
        header('Refresh: ./index.php');
    }
?>

    <!DOCTYPE html>
    <html lang="fr-FR">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>Accueil</title>
    </head>

    <body>
        <header>
            <h1 onclick="gotoindex();">Accueil</h1>
        </header>
        <form action="" method="post" class="deco-container">
            <button type="submit" name="disconected"><img src="./img/exit.png" alt=""></button>
        </form>
        <main>
            <div class="infosaccount">
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">ID:<?php echo $usersinfo['id']; ?></p>
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">E-MAIL:<?php echo $usersinfo['login']; ?></p>
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">PRENOM:<?php echo $usersinfo['prenom']; ?></p>
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">NOM:<?php echo $usersinfo['nom']; ?></p>
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">MOT DE PASSE:<?php echo $usersinfo['password']; ?></p>
                <p class="" style="font-family: Arial, Helvetica, sans-serif;">ADMIN:<?php echo $admin; ?></p>
            </div>
            <div class="btn-content">
                <form action="" method="post" class="formdo">
                    <button id="btn-edit" class="btn-choise" type="submit" name="edit-account">Editer le compte</button>
                </form>
                <?php if ($usersinfo['admin'] == 1) { ?>
                    <form action="" method="post" class="formdo">
                        <button id="btn-admin" class="btn-choise" type="submit" name="space-admin">Espace Admin</button>
                    </form>
                <?php } ?>
                <form action="" method="post" class="formdo">
                    <button id="btn-gold" class="btn-choise" type="submit" name="golden-book">Livre d'or</button>
                </form>
                <form action="" method="post" class="formdo">
                    <button id="btn-delete" class="btn-choise" type="submit" name="delete-account">Supprimer le compte</button>
                </form>
            </div>

        </main>
    </body>

    </html>
    <script src="./js/goto.js"></script>
<?php
}
?>