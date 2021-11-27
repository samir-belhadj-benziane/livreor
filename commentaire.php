<?php
include('./fileconfig/config.php');

include('./fileconfig/configusers.php');

if (isset($_SESSION['id'])) {
    if (isset($_POST['sending'])) {
        if (!empty($_POST['monpost'])) {

            $monpost = htmlspecialchars($_POST['monpost']);

            $insermessage = $bdd->prepare("INSERT INTO commentaires ( commentaire, id_utilisateur, date) VALUES (?, ?, ?)");
            $insermessage->execute(array($monpost, $_SESSION['id'], date('Y-m-d H')));
            header("Refresh:5; url=./livre-or.php");
            $reussi = "Message créer";
        }
    }

   

?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>Espace Commentaire</title>
    </head>

    <body>
        <header>
            <h1 onclick="gotoindex();">Commentaire</h1>
        </header>
        <main>
            <form action="" method="post" id="formcomment">
                <input type="text" name="monpost" id="" placeholder="Écris ton commmentaire ici">
                <button type="submit" name="sending">Send My Message</button>
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