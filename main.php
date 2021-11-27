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
        <link rel="shortcut icon" href="./img/fav.png" type="image/png">
        <title>Accueil</title>
    </head>

    <body>
        <header>
            <h1>
                <a href="./main.php">Accueil</a>
            </h1>
        </header>
        <form action="" method="post" class="deco-container">
            <button type="submit" name="disconected"><img src="./img/exit.png" alt=""></button>
        </form>
        <main>
            <div class="infosaccount">
                <h2>Bienvenue</h2>
                <h3><?php echo $usersinfo['prenom']; ?> <?php echo $usersinfo['nom']; ?></h3>
            </div>
            <div class="btn-content">
                <form action="" method="post" class="formdo">
                    <button id="btn-edit" class="btn-choise" type="submit" name="edit-account">Editer le compte</button>
                </form>
                <?php if ($usersinfo['login'] == 'admin') { ?>
                    <form action="" method="post" class="formdo">
                        <button id="btn-admin" class="btn-choise" type="submit" name="space-admin">Espace Admin</button>
                    </form>
                <?php } else { ?>
                    <form action="" method="post" class="formdo">
                        <button id="btn-admin-none" class="btn-choise" type="button" name="space-admin">Admin Innacesible</button>
                    </form>
                <?php } ?>
                <form action="" method="post" class="formdo">
                    <button id="btn-delete" class="btn-choise" type="submit" name="delete-account">Supprimer le compte</button>
                </form>
            </div>

        </main>
    </body>

    </html>

<?php
} else {
    header('Location: ./index.php');
}
?>