<?php
    $host = 'localhost';
    $dbname = 'test_mangaku';
    $username = 'root';
    $password = 'root';
    $_SESSION['membre']['prenom'] = $prenom;

    include('../homepage/index1.php');



  try {
  
    //$conn = new PDO($host;$dbname, $username, $password);
    $pdo = new PDO('mysql:host=localhost;dbname=test_mangaku', 'root', 'root', array(PDO::ATTR_ERRMODE =>
PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


    //echo "Connecté à $dbname sur $host avec succès.";

    /*$r = $pdo->query('SELECT prenom FROM membre WHERE id_membre=1');
    while($prenom = $r->fetch(PDO::FETCH_ASSOC)) {
      echo $prenom['prenom'];
    }*/
    
    
  } catch (PDOException $e) {
  
    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
  }
















  if ($_POST) {
	// Je hash le mot de passe :
	$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
  }




  if(isset($_POST['bio']) && (empty($_POST['ville'])) && (empty($_POST['email']))) {
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("UPDATE membre SET bio='$_POST[bio]' WHERE id_membre=$id_membre");
    $_SESSION['membre']['bio'] = $_POST['bio'];
    $resultat .= '<p>Changements envoyés !</p>';
  }

  if(isset($_POST['ville']) && (empty($_POST['bio'])) && (empty($_POST['email']))) {
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("UPDATE membre SET ville='$_POST[ville]' WHERE id_membre=$id_membre");
    $_SESSION['membre']['ville'] = $_POST['ville'];
    $resultat .= '<p>Changements envoyés !</p>';
  }

  if(isset($_POST['email']) && (empty($_POST['bio'])) && (empty($_POST['ville']))) {
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("UPDATE membre SET email='$_POST[email]' WHERE id_membre=$id_membre");
    $_SESSION['membre']['email'] = $_POST['email'];
    $resultat .= '<p>Changements envoyés !</p>';
  }

  if(isset($_POST['mdp']) && (empty($_POST['bio'])) && (empty($_POST['ville'])) && (empty($_POST['email'])) && (empty($_POST['fichier']))&& (empty($_POST['MAX_FILE_SIZE']))&& (empty($_POST['submit']))) {
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("UPDATE membre SET mdp='$_POST[mdp]' WHERE id_membre=$id_membre");
    $_SESSION['membre']['mdp'] = $_POST['mdp'];
    $resultat .= '<p>Changements envoyés !</p>';
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


          


<?php

//CHEMIN :

define("RACINE_SITE", '../ProjetReseauSocialMangas/');

//VARIABLE : 

$content = "";

/************************************************************
 * Definition des constantes / tableaux et variables
 *************************************************************/

// Constantes
define('TARGET', '../profil/posts_images/');    // Repertoire cible
define('MAX_SIZE', 1500000000);    // Taille max en octets du fichier
define('WIDTH_MAX', 10000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 10000);    // Hauteur max de l'image en pixels

// Tableaux de donnees
$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';
$progress = '';
$type = '';


/************************************************************
 * Creation du repertoire cible si inexistant
 *************************************************************/
if (!is_dir(TARGET)) {
	if (!mkdir(TARGET, 0755)) {
		exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
	}
}

/************************************************************
 * Script d'upload
 *************************************************************/
if (!empty($_POST)) {
	// On verifie si le champ est rempli
	if (!empty($_FILES['fichier']['name'])) {
		// Recuperation de l'extension du fichier
		$extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

		// On verifie l'extension du fichier
		if (in_array(strtolower($extension), $tabExt)) {
			// On recupere les dimensions du fichier
			$infosImg = getimagesize($_FILES['fichier']['tmp_name']);

			// On verifie le type de l'image
			if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
				// On verifie les dimensions et taille de l'image
				if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
					// Parcours du tableau d'erreurs
					if (
						isset($_FILES['fichier']['error'])
						&& UPLOAD_ERR_OK === $_FILES['fichier']['error']
					) {
						// On renomme le fichier
						$nomImage =uniqid().'.jpg';


						// Si c'est OK, on teste l'upload
						if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {

							// L'image est uploadé

						} else {
							// Sinon on affiche une erreur systeme
							$message = 'Problème lors de l\'upload !';
						}
					} else {
						$message = 'Une erreur interne a empêché l\'uplaod de l\'image';
					}
				} else {
					// Sinon erreur sur les dimensions et taille de l'image
					$message = 'Erreur dans les dimensions de l\'image !';
				}
			} else {
				// Sinon erreur sur le type de l'image
				$message = 'Le fichier à uploader n\'est pas une image !';
			}
		} else {
			// Sinon on affiche une erreur pour l'extension
			$message = 'L\'extension du fichier est incorrecte !';
		}
	} else {
		// Sinon on affiche une erreur pour le champ vide
		// $message = 'Veuillez remplir le formulaire svp !';
	}
}


if (!empty($message)) {
	echo '<p>', "\n";
	echo "\t\t<strong>", htmlspecialchars($message), "</strong>\n";
	echo "\t</p>\n\n";
}

$id_membre = $_SESSION['membre']['id_membre'];
if ($_POST['submit']) {
  $pdo->exec("UPDATE membre SET photo_profil='$nomImage' WHERE id_membre=$id_membre");
  $_SESSION['membre']['photo_profil'] = $nomImage;
  header("Refresh:1");
  $resultat .= '<p>Changements validés !</p>';
}

if ($_POST['submit1']) {
  $pdo->exec("UPDATE membre SET photo_couverture='$nomImage' WHERE id_membre=$id_membre");
  $_SESSION['membre']['photo_couverture'] = $nomImage;
  $resultat .= '<p>Changements validés !</p>';
}
?>












<!-- Photo de profil -->
<section class="main">
<form method="post" class="formPublication" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label> Photo de profil :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="fichier_a_uploader" />
            <input type="hidden" name="submit" value="Valider" class="cta" />
            <input type="submit" value="Changer" class="boutonPublier"></div>
        </form><br>
<!-- Fin photo de profil -->

<!-- Photo de couverture -->
<form method="post" class="formPublication" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label> Photo de couverture :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="fichier_a_uploader" />
            <input type="hidden" name="submit1" value="Valider" class="cta" />
            <input type="submit" value="Changer" class="boutonPublier"></div>
        </form><br>
<!-- Fin photo de couverture -->

  </div>
</div>







        <form method="post">
            <label for="bio" class="div"> Bio :</label>
            <input type="text" name="bio" required> 
            <input type="submit" value="Changer"></div> 
        </form><br>

        <form method="post">
            <label for="ville" class="div"> Ville :</label>
            <input type="text" name="ville" required> 
            <input type="submit" value="Changer"></div> 
        </form><br>

        <form method="post">
            <label for="email" class="div"> Adresse Mail :</label>
            <input type="text" name="email" required> 
            <input type="submit" value="Changer"></div> 
        </form><br>

        <form method="post">
            <label for="mdp" class="div"> Mot de passe :</label>
            <input type="password" name="mdp" required> 
            <input type="submit" value="Changer"></div> 
        </form><br><br>


            <?php echo $resultat; 
?>
        </section>
        </section>
    </main>
</body>
<script src="../scriptgeneral.js"></script>
</html>



























