<?php

include('../homepage/index1.php');


    $host = 'localhost';
    $dbname = 'test_mangaku';
    $username = 'root';
    $password = 'root';
 
  try {
  
    //$conn = new PDO($host;$dbname, $username, $password);
    $pdo = new PDO('mysql:host=localhost;dbname=test_mangaku', 'root', 'root', array(PDO::ATTR_ERRMODE =>
PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


    //echo "Connecté à $dbname sur $host avec succès.";

    
    
  } catch (PDOException $e) {
  
    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
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
    <main>


        <section class="sidebar">
        <img class="imgLogo" src="../logo_finale.svg" alt="" id="raccourci">
        <figure id="profil"><?php echo'<img class="imgProfil" src="../profil/posts_images/' . $_SESSION['membre']['photo_profil'].'">' ?><figcaption>Profil</figcaption></figure>
            <hr class="separation">
            <figure id="filactu"><img src="../Sidebarlogo/fileactu.svg" alt=""><figcaption>Fil d'actualité</figcaption></figure>
            <figure id="amis"><img src="../Sidebarlogo/ami.svg" alt=""><figcaption>Communauté</figcaption></figure>
            <figure id="message"><img src="../Sidebarlogo/message.svg" alt=""><figcaption>Message</figcaption></figure>
            <figure><img src="../Sidebarlogo/groupe.svg" alt=""><figcaption>Groupe</figcaption></figure>
            <figure><img src="../Sidebarlogo/notifications.svg" alt=""><figcaption>Notifications</figcaption></figure>
            <figure id="parametres"><img src="../Sidebarlogo/parametres.svg" alt=""><figcaption>Parametres</figcaption></figure>
        </section>


<!-- Tous les membres de Mangaku -->
<section class= mainligne>
<?php 

                  $r = $pdo->query('SELECT prenom, nom, id_membre, photo_profil FROM membre');
                    while($prenom = $r->fetch(PDO::FETCH_ASSOC))  {
                    echo '<figure id="unAmi"><img src="../profil/posts_images/' . $prenom['photo_profil'].'">'.$prenom['prenom']. ' ' . $prenom['nom']?>
                    <a href="../profil/testautre.php?id=<?= $prenom['id_membre']?>">Aller au profil</a></figure>
                    <?php   }    ?>

</section>















          






        <!--        <figure><img src="./Amis/Luffy.jpg"><figcaption>@Luffy</figcaption></figure>
                <figure><img src="./Amis/Kakashi.jpg"><figcaption>@Kakashi</figcaption></figure>
                <figure><img src="./Amis/Saitama.jpg"><figcaption>@Saitama</figcaption></figure>-->
            </section>

    </main>
</body>
<script src="../scriptgeneral.js"></script>
</html>