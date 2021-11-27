<?php

include('./fileconfig/config.php');

if (isset($_SESSION['id'])) {

    include('./fileconfig/configusers.php');

    $getmess = $bdd->prepare("SELECT * FROM commentaires WHERE id_utilisateur = ? ORDER BY date DESC ");
    $getmess->execute(array($_SESSION['id']));
    $getmessinfos = $getmess->fetchAll();


    if (isset($_POST['btn-add'])) {
        header('Location: ./commentaire.php');
    }

?>

    <!DOCTYPE html>
    <html lang="fr-FR">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>Livre D'or</title>
    </head>

    <body>
        <header>
            <h1 onclick="gotoindex();">Livre D'or</h1>
        </header>
        <main>
            <?php foreach ($getmessinfos as $messinfos) {
                $getusmes = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                $getusmes->execute(array($messinfos['id_utilisateur']));
                $getusmesinfos = $getusmes->fetch();
            ?>
                <div class="content-goldenbook">
                    <div class="top-goldenbook">
                        <h2><?php echo $getusmesinfos['prenom'] ?></h2>
                        <p><?php echo $messinfos['date'] ?></p>
                    </div>
                    <div class="body-goldenbook">
                        <p><?php echo $messinfos['commentaire'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </main>

        <div class="container-add">
            <form action="" method="post">
                <button type="submit" class="btn-add" name="btn-add"><img src="./img/plus.png" alt=""></button>
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