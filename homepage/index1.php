<?php

// Je me connecte à la base de données : 
$pdo = new PDO('mysql:host=localhost;dbname=test_mangaku', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

// var_dump($pdo);


// J'ouvre une session pour y stocker des infos
session_start();
// S'il y a une action dans l'URL et si cette action est égal à deconnexion, alors je détruit la session :
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
	session_destroy();
	// Je le rédirige vers l'accueil :
	header('location:../homepage/connexion.php');
}

// Je déclare une variable qui me permet d'afficher des messages pour l'utilisateur
$content = '';







?>