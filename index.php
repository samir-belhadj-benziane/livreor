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
    <link rel="stylesheet" href="./css/style.css">
    <title>Menu principal</title>
</head>

<body>
    <header>
        <h1>Menu principal</h1>
    </header>
    <main>
        <form action="" method="post" class="formgoto">
            <div class="container-of-btn">
                <button type="submit" name="gosignup">
                    <h2>Incription</h2>
                </button>
                <button type="submit" name="gosignin">
                    <h2>Connexion</h2>
                </button>
                <button type="submit" name="gogit">
                    <h2>GitHub</h2>
                </button>
            </div>
        </form>
    </main>
</body>

</html>