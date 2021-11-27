<?php
include('./fileconfig/config.php');

include('./fileconfig/configusers.php');

if ($usersinfo['admin'] == 1) {

    $recupadmin = $bdd->query('SELECT * FROM utilisateurs ORDER BY id ASC');
    if (!empty($_POST['admin-sub'])) {

        $idadmin = intval($_GET['idadmin']);

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $login = htmlspecialchars($_POST['login']);
        $password = sha1($_POST['password']);
        $admin = htmlspecialchars($_POST['admin']);

        if (!empty($_POST['prenom'])) {
            $prenomlenght = strlen($prenom);
            if ($prenomlenght >= 2 && $prenomlenght <= 18) {
                $inserprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
                $inserprenom->execute(array($prenom, $idadmin));
                header("Refresh:5");
                $reussi = "Vous avez modifié le prenom";
            } else {
                header("Refresh:5");
                $erreur = "Le prenom doit contenir 2 a 18 caractères !";
            }
        }

        if (!empty($_POST['nom'])) {
            $nomlenght = strlen($nom);
            if ($nomlenght >= 2 && $nomlenght <= 18) {
                $insernom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
                $insernom->execute(array($nom, $idadmin));
                header("Refresh:5");
                $reussi = "Vous avez modifié le nom";
            } else {
                header("Refresh:5");
                $erreur = "Le nom doit contenir 2 a 18 caractères !";
            }
        }

        if (!empty($_POST['login'])) {
            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                $reqmail->execute(array($login));
                $mailexist = $reqmail->rowCount();
                if ($mailexist == 0) {
                    $inserlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
                    $inserlogin->execute(array($login, $idadmin));
                    header("Refresh:5");
                    $reussi = "Vous avez modifié le mail";
                } else {
                    header("Refresh:5");
                    $erreur = "Adresse mail est deja éxistante !";
                }
            } else {
                header("Refresh:5");
                $erreur = "L'Adresse Mail n'est pas valide";
            }
        }

        if (!empty($_POST['password'])) {
            $inserpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $inserpassword->execute(array($password, $idadmin));
            header("Refresh:5");
            $reussi = "Vous avez modifié le mots de passe";
        }

        if (!empty($_POST['admin'])) {
            $inseradmin = $bdd->prepare("UPDATE utilisateurs SET admin = ? WHERE id = ?");
            $inseradmin->execute(array($admin, $idadmin));
            header("Refresh:5");
            $reussi = "Vous avez modifié le statue d'admin";
        }
    }

    if (!empty($_POST['btn-dd'])) {
        $idadmin = intval($_GET['idadmin']);
        $suppr = $bdd->prepare('DELETE FROM utilisateurs WHERE id = ?');
        $suppr->execute(array($idadmin));
        header('Refresh: ./index.php');
    }


?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/admin.css">
        <title>Espace Admin</title>
    </head>

    <body>
        <?php
        if (!empty($_POST['admin-sub'])) { ?>
            <?php if (!empty($erreur)) { ?>
                <div class="message-container" style="background-color: red ;">
                    <p style="color: tomato;"><?php echo $erreur; ?></p>
                </div>
            <?php
            } elseif (!empty($reussi)) { ?>
                <div class="message-container" style="background-color: green;">
                    <p style="color: greenyellow;"><?php echo $reussi; ?></p>
                </div>
            <?php
            } ?>
        <?php
        }
        ?>
        <header>
            <h1 onclick="gotoindex();">Espace Admin</h1>
        </header>
        <main>
            <table>
                <tr>
                    <th>ID</th>
                    <th>MAIL</th>
                    <th>PRÉNOM</th>
                    <th>NOM</th>
                    <th>MOTS DE PASSE</th>
                    <th>ADMIN</th>
                    <th>ÉDITER</th>
                    <th>SUPPRIMER</th>
                </tr>
                <?php while ($admininfos = $recupadmin->fetch()) { ?>
                    <form action="?idadmin=<?= $admininfos['id']; ?>" method="post">
                        <tr>
                            <td>
                                <p><?= $admininfos['id']; ?></p>
                            </td>
                            <td>
                                <input type="email" name="login" id="" placeholder="<?= $admininfos['login']; ?>">
                            </td>
                            <td>
                                <input type="text" name="prenom" id="" placeholder="<?= $admininfos['prenom']; ?>">
                            </td>
                            <td>
                                <input type="text" name="nom" id="" placeholder="<?= $admininfos['nom']; ?>">
                            </td>
                            <td>
                                <input type="password" name="password" id="" placeholder="<?= $admininfos['password']; ?>">
                            </td>
                            <td>
                                <select name="admin" id="">
                                    <option value="">Aucun Changement</option>
                                    <option value="1">Admin</option>
                                    <option value="0">Non-Admin</option>
                                </select>
                            </td>
                            <td>
                                <input type="submit" style="color: green;" name="admin-sub" value="ÉDITER">
                            </td>
                            <td>
                                <input type="submit" style="color: red;" name="btn-dd" value="SUPPRIMER">
                            </td>
                        </tr>
                    </form>
                <?php
                }
                ?>

            </table>
        </main>
    </body>

    </html>

    <script src="./js/goto.js"></script>
<?php
} else {
    header('Location: ./main.php');
}
?>