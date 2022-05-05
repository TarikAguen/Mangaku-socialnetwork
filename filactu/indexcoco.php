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


  if($_POST['titre_publication'] && $_POST['message_publication']) {
    $content .= '<p>Publication validée !</p>';
    $id_membre = $_SESSION['membre']['id_membre'];
    $pdo->exec("INSERT INTO publication (titre_publication, message_publication, id_membre) VALUES ( '$_POST[titre_publication]', '$_POST[message_publication]', $id_membre)");  

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
</head>
<body>
    <main>


        <section class="sidebar">
            <img class="imgLogo" src="../logo_finale.svg" alt="">
            <figure><img class="imgProfil" src="../Sidebarlogo/Profil.png" alt="profil"><figcaption>Profil</figcaption></figure>
            <hr class="separation">
            <figure><img src="../Sidebarlogo/fileactu.svg" alt=""><figcaption>Fil d'actualité</figcaption></figure>
            <figure><img src="../Sidebarlogo/ami.svg" alt=""><figcaption>Amis</figcaption></figure>
            <figure><img src="../Sidebarlogo/message.svg" alt=""><figcaption>Message</figcaption></figure>
            <figure><img src="../Sidebarlogo/groupe.svg" alt=""><figcaption>Groupe</figcaption></figure>
            <figure><img src="../Sidebarlogo/notifications.svg" alt=""><figcaption>Notifications</figcaption></figure>
            <figure><img src="../Sidebarlogo/parametres.svg" alt=""><figcaption>Parametres</figcaption></figure>



        </section>


        <section class="other">
            <div class="tt_tendance">
                <div class="tag">
                    <h3>TAG POUR VOUS</h3>
                    <p>TAG 1</p>
                    <hr>
                    <p>TAG 1</p>
                    <hr>
                    <p>TAG 1</p>
                    <hr>
                    <p>TAG 1</p>
                    <hr>
                    <p>TAG 1</p>
                    <hr>
                    <p>TAG 1</p>
                    <hr>
                    <p>Voir plus</p>
                    
                </div>

                <div class="tendance">
                    <h3>Tendance</h3>
                    <hr>
                    <div class="tendace_1">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, asperiores.</p>
                        <img class="img_tend" src="../logo_finale.svg" alt="">
                        <hr>
                    </div>
                    <div class="tendace_1">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, asperiores.</p>
                        <img class="img_tend"  src="../logo_finale.svg" alt="">
                        <hr>
                    </div>
                    <div class="tendace_1">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, asperiores.</p>
                        <img  class="img_tend" src="../logo_finale.svg" alt="">
                        <hr>
                    </div>

                </div>
            </div>

            <div class="tt_filactu">
                

            <!--    <div class="publication">
                    <div class="profil_actu">
                        <img src="profil.png" alt="">
                        <p class="p_profil_publi">@KIRUA</p>
                    </div>
                    <div class="publi_actu">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, repudiandae.</p>
                        <img class="img_publi_actu" src="publication.png" alt="">
                    </div>
                    <div class="svg_actu">
                        <img src="heart.svg" alt="">
                        <img src="comment.svg" alt="">
                        <img src="share.svg" alt="">
                    </div>
                    <div class="comment_actu">
                        <img src="profil.png" alt="">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime dignissimos provident tempore voluptatum corrupti deserunt.</p>
                        <hr>
                        <form method="post">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo">
                            <br> <br>
                            <label for="message">Message</label>
                            <textarea name="message" id="message" placeholder="Votre message" cols="10" rows="3"></textarea>
                            <br> <br>
                            <input type="submit">
                        </form>
                        <hr>
                    </div>
                </div>

                <div class="publication">
                    <div class="profil_actu">
                        <img src="profil.png" alt="">
                        <p class="p_profil_publi">@KIRUA</p>
                    </div>
                    <div class="publi_actu">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, repudiandae.</p>
                        <img class="img_publi_actu" src="publication.png" alt="">
                    </div>
                    <div class="svg_actu">
                        <img src="heart.svg" alt="">
                        <img src="comment.svg" alt="">
                        <img src="share.svg" alt="">
                    </div>
                    <div class="comment_actu">
                        <img src="profil.png" alt="">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime dignissimos provident tempore voluptatum corrupti deserunt.</p>
                    </div>
                </div>
                <div class="publication">
                    <div class="profil_actu">
                        <img src="profil.png" alt="">
                        <p class="p_profil_publi">@KIRUA</p>
                    </div>
                    <div class="publi_actu">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, repudiandae.</p>
                        <img class="img_publi_actu" src="publication.png" alt="">
                    </div>
                    <div class="svg_actu">
                        <img src="heart.svg" alt="">
                        <img src="comment.svg" alt="">
                        <img src="share.svg" alt="">
                    </div>
                    <div class="comment_actu">
                        <img src="profil.png" alt="">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime dignissimos provident tempore voluptatum corrupti deserunt.</p>
                    </div>
                </div>-->



















                <div class= mainPublication>
<!-- Publication -->
            <?php 
            $auteur = $pdo->query('SELECT prenom, nom FROM membre WHERE id_membre='.$_SESSION['membre']['id_membre']);
       while($prenomAuteur = $auteur->fetch(PDO::FETCH_ASSOC))  {
         
            $r = $pdo->query('SELECT titre_publication, message_publication, id_publication FROM publication WHERE id_membre='.$_SESSION['membre']['id_membre']);
      while($publication = $r->fetch(PDO::FETCH_ASSOC))  {
      echo '<div class="publicationAuteur">'.'<img src="kirua.png" class="photoProfilPublication">'.'<a class = pseudo>'.$prenomAuteur['prenom'].' '.$prenomAuteur['nom'].'</a>'.'<p class="titrePublication">'.$publication['titre_publication'].'</p>'. '<br>'.'<p class= messagePublication>'.$publication['message_publication'].'</p>';         
      echo '<p class="icones">        
                    <img src="./Icones/Like.svg" alt="" class="Like">
                    <img src="./Icones/Partager.svg" alt="" class="Partager">
                </p>
              
          <form method="post">
            <label for="texte_commentaire"> Commentaire :</label>
            <input type="text" name="texte_commentaire" required>
            <input type="submit" value="Publier"></div> 
            <input type="hidden" name="id_publication" value="'.$publication['id_publication'].'"/>
        </form></div>';


    /* Commentaire */
          //  $s = $pdo->query('SELECT prenom, nom FROM membre WHERE id_membre=1');

         /*  $s = $pdo->query(' SELECT c.texte_commentaire, m.nom, m.prenom
            FROM commentaire c, membre m
            WHERE  c.id_membre = m.id_membre AND c.id_publication='.$publication['id_publication']);

       while($prenom = $s->fetch(PDO::FETCH_ASSOC))  {*/
       $n = $pdo->query('       
       SELECT c.texte_commentaire, m.nom, m.prenom
       FROM commentaire c, membre m
       WHERE  c.id_membre = m.id_membre AND c.id_publication='.$publication['id_publication']);
       while($texte_commentaire = $n->fetch(PDO::FETCH_ASSOC)){
         
      echo     '<section class="toutCommentaire">'; 
      echo     '<section class="commentaire">'.'<img src="kirua.png" class="photoProfilCommentaire">'.' '.'<a class="pseudoCommentaire">'.$texte_commentaire['prenom'].' '.'</a>'.'<a class="pseudoCommentaire">'.$texte_commentaire['nom'].' '.'</a>'.'<a class="messageCommentaire">'.$texte_commentaire['texte_commentaire'].'</a>'.'</section>';
      echo '</section>';
    }
      }echo '<br>';
    }
  //}
       ?>
    <!-- Fin commentaire -->


















                
                
            </div>

            <div class="tt_ami">
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>

                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
                <div class="friends">
                    <img src="onepiece.svg" alt="">
                    <p>@LUFFY</p>
                </div>
            </div>

        </section>

    </main>
</body>
</html>