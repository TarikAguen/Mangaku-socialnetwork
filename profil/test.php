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


        <section class="couverture">
        <?php echo'<img src="../profil/posts_images/' . $_SESSION['membre']['photo_couverture'].'">' ?><br>
    
        </section>



<section class="main">
        <section class="profil">

            <figure><?php echo'<img src="../profil/posts_images/' . $_SESSION['membre']['photo_profil'].'">' ?><br></figure>
           <!-- src="../profil/posts_images/' . ($publication['image_publication']) . '">';-->

<!-- Prénom -->
            <?php   echo $_SESSION['membre']['prenom']

        ?>   
<!-- Nom -->
<?php      echo $_SESSION['membre']['nom']
           ?><br><br>

            <input class="" type="button" onclick="self.location.href='../settings/index.php'" value="Modifier"><br><br>

<!-- Bio -->
<?php   
      echo '<p>';
      echo $_SESSION['membre']['bio'];
      echo '</p><br>';
        ?>

<!-- Ville -->
<?php   
      echo '<p>';
      echo $_SESSION['membre']['ville'];
      echo '</p><br>';
        ?>
            
<!-- Date de naissance -->
<?php   
      echo '<p>';
      echo $_SESSION['membre']['date_naissance'];
      echo '</p><br>';
      $_SESSION['profil_ami'] = 0;
        ?>


		<a href="?action=deconnexion">Déconnexion</a>


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

if ($_POST['titre_publication'] && $_POST['message_publication']) {
  $content .= '<p>Publication validée !</p>';
  $id_membre = $_SESSION['membre']['id_membre'];
  $pdo->exec("INSERT INTO publication (titre_publication, message_publication, id_membre, image_publication) VALUES ( '$_POST[titre_publication]', '$_POST[message_publication]', $id_membre, '$nomImage')");
}
if (isset($_POST['texte_commentaire'])) {
  $content .= '<p>Commentaire validé !</p>';
  $pdo->exec("INSERT INTO commentaire (id_publication, texte_commentaire, id_membre) VALUES ( '$_POST[id_publication]', '$_POST[texte_commentaire]', 1)");
}
?>









<!-- PUBLIER -->
        <section class="publication">
        <form method="post" class="formPublication" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" name="titre_publication" class="inputTitrePublication" placeholder = "Titre publication :" required><br>
            <input type="text" name="message_publication" class="inputMessagePublication" placeholder = "Message publication :" required> 
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="fichier_a_uploader" />
            <input type="hidden" name="submit" value="Valider" class="cta" />
            <input type="submit" value="Publier" class="boutonPublier"></div>
        </form><br>



        <div class=mainPublication>
          <!-- Publication -->
          <?php
          $auteur = $pdo->query('SELECT prenom, nom, photo_profil FROM membre WHERE id_membre=' . $_SESSION['membre']['id_membre']);
          while ($prenomAuteur = $auteur->fetch(PDO::FETCH_ASSOC)) {

            $r = $pdo->query('SELECT titre_publication, message_publication, id_publication, image_publication FROM publication WHERE id_membre=' . $_SESSION['membre']['id_membre']);
            while ($publication = $r->fetch(PDO::FETCH_ASSOC)) {
              echo '<div class="publicationAuteur">' . '<img src="../profil/posts_images/' . $prenomAuteur['photo_profil'].'" class="photoProfilPublication">' . '<a class = pseudo>' . $prenomAuteur['prenom'] . ' ' . $prenomAuteur['nom'] . '</a>' . '<p class="titrePublication">' . $publication['titre_publication'] . '</p>' . '<br>' . '<p class="messagePublication">' . $publication['message_publication'] . '</p>' . '<br>' . '<img class="image_publication" src="../profil/posts_images/' . ($publication['image_publication']) . '">';
              echo '<p class="icones">
                    <img src="./Icones/Like.svg" alt="" class="Like">
                </p>

          <form method="post">
            <label for="texte_commentaire"> Commentaire :</label>
            <input type="text" name="texte_commentaire" required>
            <input type="submit" value="Publier"></div> 
            <input type="hidden" name="id_publication" value="' . $publication['id_publication'] . '"/>
        </form></div>';




    /* Commentaire */
       $n = $pdo->query('       
       SELECT c.texte_commentaire, m.nom, m.prenom, m.photo_profil
       FROM commentaire c, membre m
       WHERE  c.id_membre = m.id_membre AND c.id_publication='.$publication['id_publication']);
       while($texte_commentaire = $n->fetch(PDO::FETCH_ASSOC)){
         
      echo     '<section class="toutCommentaire">'; 
      echo     '<section class="commentaire">'.'<img src="../profil/posts_images/' . $texte_commentaire['photo_profil'].'" class="photoProfilCommentaire">'.' '.'<a class="pseudoCommentaire">'.$texte_commentaire['prenom'].' '.'</a>'.'<a class="pseudoCommentaire">'.$texte_commentaire['nom'].' '.'</a>'.'<a class="messageCommentaire">'.$texte_commentaire['texte_commentaire'].'</a>'.'</section>';
      echo '</section>';
    }
      }echo '<br>';
    }
  //}
       ?>
    <!-- Fin commentaire -->



</section>

  </div>










<!-- Amis -->
        <section class="amisEtPhotos">
            <section class="amis">
                <input class="boutonAmis" type="button" value="Suivi"><br>
                
          <?php 
            $r = $pdo->query('SELECT prenom, nom, id_membre, photo_profil FROM membre WHERE id_membre IN(SELECT id_membre FROM followers WHERE id_celui_qui_follow = '.$_SESSION['membre']['id_membre'].')');
      while($prenom = $r->fetch(PDO::FETCH_ASSOC))  {
      echo '<figure id="profil_ami'.$prenom['id_membre'].'"><img src="../profil/posts_images/' . $prenom['photo_profil'].'">'.'<figcaption>'.$prenom['prenom'].'_'. $prenom['nom'].'<br>'?> 
      <a href="../profil/testautre.php?id=<?= $prenom['id_membre']?>">Aller au profil</a></figure><br>
   <?php
    }    ?>
  </figcaption>


          






        <!--        <figure><img src="./Amis/Luffy.jpg"><figcaption>@Luffy</figcaption></figure>
                <figure><img src="./Amis/Kakashi.jpg"><figcaption>@Kakashi</figcaption></figure>
                <figure><img src="./Amis/Saitama.jpg"><figcaption>@Saitama</figcaption></figure>-->
            </section>
        </section>
    </section>

    </main>

</body>

<script src="../scriptgeneral.js"></script>
</html>