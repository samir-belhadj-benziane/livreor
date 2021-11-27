<?php

include('./fileconfig/config.php');

if (isset($_POST['gosignup'])) {
    header('Location: ./inscription.php');
} elseif (isset($_POST['gosignin'])) {
    header('Location: ./connexion.php');
} elseif (isset($_POST['gogit'])) {
    header('Location: https://github.com/Samir-Belhadj');
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/fav.png" type="image/png">
    <link rel="stylesheet" href="./css/style.css">
    <title>Menu principal du Golden Book</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/golden-book.png" alt="">
            <h2>Golden Book</h2>
        </div>
        <nav>
            <form action="" method="post" class="formgoto">
                <button type="submit" name="gosignup">
                    <h2>Incription</h2>
                </button>
                <button type="submit" name="gosignin">
                    <h2>Connexion</h2>
                </button>
                <button type="submit" name="gogit">
                    <h2>GitHub</h2>
                </button>
            </form>
        </nav>
    </header>
    <main>


    </main>
</body>

</html>