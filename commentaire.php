<?php
include('./fileconfig/config.php');

include('./fileconfig/configusers.php');

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

if (isset($_SESSION['id'])) {
    if (isset($_POST['sending'])) {
        if (!empty($_POST['monpost'])) {

            $monpost = htmlspecialchars($_POST['monpost']);

            $insermessage = $bdd->prepare("INSERT INTO commentaires ( commentaire, id_utilisateur, date) VALUES (?, ?, ?)");
            $insermessage->execute(array($monpost, $_SESSION['id'], date('Y-m-d H:i:s')));
            header("Refresh:5; url=./livre-or.php");
            $reussi = "Message créer";
        }
    }


    if (isset($_POST['golivreor'])) {
        header('Location: ./livre-or.php');
    }


?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/sign-in-and-up.css">
    <link rel="shortcut icon" href="./img/fav.png" type="image/png">
        <title>Espace Commentaire</title>
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
            <form action="" method="post" id="form-comment">
                <div class="container-input" id="container-input-comment">
                    <input type="text" name="monpost" id="login-input-comment" class="login-input" placeholder="Écris ton commmentaire ici">
                </div>

                <div class="container-input">
                    <button type="submit" class="login-submit" name="sending">Send My Message</button>
                </div>

            </form>

        </main>
    </body>

    </html>

    <script src="./js/goto.js"></script>
<?php
} else {
    header('Location: ./index.php');
}
?>