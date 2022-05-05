<?php
include('index1.php');

// Si la session membre existe, alors je redirige vers l'accueil :
if(isset($_SESSION['membre'])) {
    header('location:../profil/test.php');
}

// Si le form est posté :
if($_POST) {
    // Je vérifie si je récupère bien les infos :
    // var_dump($_POST);

    // Je récupère les infos correspondants à l'email dans la table :
    $r = $pdo->query("SELECT * FROM membre WHERE email = '$_POST[email]'");

    // Si le nombre de résultat est plus grand ou égal à 1, alors le compte existe :
    if($r->rowCount() >= 1) {
        // Je stock toutes les infos sous forme d'array :
        $membre = $r->fetch(PDO::FETCH_ASSOC);
        // Je vérifie si j'ai bien toutes les infos dans l'array :
        // print_r($membre);
        // Si le mot de passe posté correspond à celui présent dans $membre :
        if(password_verify($_POST['mdp'], $membre['mdp'])) {
            // Je test si le mdp fonctionne :
            $content .= '<p>email + MDP : OK</p>';
            // J'enregistre les infos dans la session :
            $_SESSION['membre']['nom'] = $membre['nom'];
            $_SESSION['membre']['prenom'] = $membre['prenom'];
            $_SESSION['membre']['email'] = $membre['email'];
            $_SESSION['membre']['id_membre'] = $membre['email'];
            // Je redirige l'utilisateur vers la page d'accueil :
            header('location:../profil/test.php');
        } else {
            // Le mot de passe est incorrect :
            $content .= '<p>Mot de passe incorrect.</p>';
        }
    } else {
        $content .= '<p>Compte inexistant</p>';
    }

}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <link href="./styleco.css" rel="stylesheet">
    </head>

    <body>

        <?php echo $content; ?>
        <div class="returnArrow"><a href="./inscription.php"><img src="../images/return.svg" alt=""></a>
        </div>
    <div class="boardConnexion">
        <form method="post">
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
            <br><br>
            <input type="submit" class="seconnecter" value="Se connecter">
        </form>
    </div>

    </body>
</html>