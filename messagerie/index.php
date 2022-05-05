<?php

include('../homepage/index1.php');

    $host = 'localhost';
    $dbname = 'test_mangaku';
    $username = 'root';
    $password = 'root';
    $membre['profil_ami'] = 0;
    
 
  try {
  
    //$conn = new PDO($host;$dbname, $username, $password);
    $pdo = new PDO('mysql:host=localhost;dbname=test_mangaku', 'root', 'root', array(PDO::ATTR_ERRMODE =>
PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


    //echo "Connecté à $dbname sur $host avec succès.";

    
    
  } catch (PDOException $e) {
  
    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
  }


 
  if(isset($_POST['texte_commentaire'])) {
    $content .= '<p>Commentaire validé !</p>';
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("INSERT INTO commentaire (id_publication, texte_commentaire, id_membre) VALUES ( '$_POST[id_publication]', '$_POST[texte_commentaire]', $id_membre)");
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MANGAKU</title>
    <link rel="shortcut icon" href="../logo1.svg">
</head>
<body>
    <header>
        <section class="iconesHeader">
            <img src="iconeRetour.svg" alt="" class="retour" id="raccourci">
            <figure class="iconeNotifs"><img src="../Sidebarlogo/fileactu.svg" alt="" id="filactu"><figcaption>Fil d'actualité</figcaption></figure>
            <figure class="iconeAmis" id="amis"><img src="../Sidebarlogo/ami.svg" alt="" ><figcaption>Communauté</figcaption> </figure>
            <img src="../logo_finale.svg" alt="" class="logoHeader" id="message">
            <figure class="iconeGroupe"><img src="../Sidebarlogo/groupe.svg" alt="" id="profil"><figcaption>Profil</figcaption></figure>
            <figure class="iconeParametres" id="parametres"><img src="../Sidebarlogo/parametres.svg" alt=""><figcaption>Parametres</figcaption></figure>
        </section>
    </header>

<main>


</main>
    
</body>
<script src="../scriptgeneral.js"></script>
</html>