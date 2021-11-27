<?php

include('./fileconfig/config.php');

if (isset($_SESSION['id'])) {

    include('./fileconfig/configusers.php');

    $getmess = $bdd->prepare("SELECT * FROM commentaires WHERE id_utilisateur = ? ORDER BY date DESC ");
    $getmess->execute(array($_SESSION['id']));
    $getmessinfos = $getmess->fetchAll();

    if (isset($_POST['goprofil'])) {
        header('Location: ./profil.php');
    }

    if (isset($_POST['btn-add'])) {
        header('Location: ./commentaire.php');
    }
    
    if (isset($_POST['disco'])) {
        session_destroy();
        header('Location: ./index.php');
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
        <title>Livre d'or</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="./img/golden-book.png" alt="">
                <h2>Golden Book</h2>
            </div>
            <nav>
                <form action="" method="post" class="formgoto" id="formgoto-goldbook">
                    <button type="submit" name="goprofil">
                        <h2 title="Profile"><?php echo $usersinfo['login'] ?></h2>
                    </button>
                </form>
            </nav>
        </header>
        <main id="main-dor">
            <?php foreach ($getmessinfos as $messinfos) {
                $getusmes = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                $getusmes->execute(array($messinfos['id_utilisateur']));
                $getusmesinfos = $getusmes->fetch();
            ?>
                <div class="content-goldenbook">
                    <div class="top-goldenbook">
                        <h2><?php echo $getusmesinfos['login'] ?></h2>
                        <p><?php echo $messinfos['date'] ?></p>
                    </div>
                    <div class="body-goldenbook">
                        <p><?php echo $messinfos['commentaire'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </main>

        

        <div class="container-disco">
            <form action="" method="post">
                <button type="submit" class="btn-add" name="disco" title="Déconnexion"><img src="./img/logout.png" alt=""></button>
            </form>
        </div>

        <div class="container-add">
            <form action="" method="post">
                <button type="submit" class="btn-add" name="btn-add" title="Ajouter un commentaire"><img src="./img/plus.png" alt=""></button>
            </form>
        </div>
    </body>

    </html>
    <script src="./js/goto.js"></script>
<?php
} else {
    header('Location: ./index.php');
}
?>