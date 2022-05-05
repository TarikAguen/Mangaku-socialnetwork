<?php
include('index1.php');
// var_dump($_POST);
// Si la session membre existe, alors je redirige vers l'accueil :
if (isset($_SESSION['membre'])) {
	header('location:../profil/test.php');
}

// Si le form a été posté :
if ($_POST) {
	// Je vérifie si je récupère bien les valeurs des champs :
	// print_r($_POST);

	// Je défini une variable pour afficher les erreurs :
	$erreur = '';

	// Si le prenom n'est pas trop court ou trop long :
	if (strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) {
		$erreur .= '<p>Taille de prénom invalide.</p>';
	}

	// Si les caractères utilisées dans le champs prénoms sont valides :
	if (!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['prenom'])) {
		$erreur .= '<p>Format de prénom invalide.</p>';
	}

	// Je vérifie si l'email n'est pas déjà présent dans la base :
	$r = $pdo->query("SELECT * FROM membre WHERE email = '$_POST[email]'");
	// S'il y a un ou plusieurs résultats :
	if ($r->rowCount() >= 1) {
		$erreur .= '<p>Email déjà utilisé.</p>';
	}

	// Je gère les problèmes d'apostrophes pour chaque champs grâce à une boucle :
	foreach ($_POST as $indice => $valeur) {
		$_POST[$indice] = addslashes($valeur);
	}

	// Je hash le mot de passe :
	$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

	// Si $erreur est vide (fonction empty() vérifie si une variable est vide) :
	if (empty($erreur)) {
		// J'envois les infos dans la table en BDD :
		$pdo->exec("INSERT INTO membre (nom, prenom, email, mdp, sexe, date_naissance) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[mdp]', '$_POST[sexe]', '$_POST[date]')");
		// J'ajoute un message de validation :
		$content .= '<p>Inscription validée !</p>';
	}



	header('location:connexion.php');
	// J'ajoute le contenu de $erreur à l'interieur de $content :
	$content .= $erreur;
}












































?>
<!DOCTYPE html>
<html>

<head>
	<title>Inscription</title>
	<link href="./style.css" rel="stylesheet">
</head>

<body>

	<!-- J'affiche la variable content : -->
	<?php echo $content; ?>
	<div class="allContent" id="allContent">
		<div class="leftContent">
			<img src="../logo finale.svg" alt="" width="370" height="370" />
			<section class="mainOn" id="mainOn">
				<a href="./connexion.php"><input type="button" value="SE CONNECTER" id="seConnecter" class="seConnecter"></a>
			</section>
		</div>
		<div class="rightContent">
			<div class="register">
				<div class="registerTitle">
					<h1>INSCRIPTION<span class="registJap"> <img src="../images/inscription.svg" alt="register in japanese"></span></h1>
				</div>
				<form method="post">
					<div class="nameLastName">
						<div class="name">
							<label class="labelLastname" for="nom">Nom</label>
							<input class="inputLastname" type="text" name="nom" id="nom" required>
						</div>
						<br><br>
						<div class="lastName">
							<label class="labelName" for="prenom">Prénom</label>
							<input class="inputName" type="text" name="prenom" id="prenom" minlength="3" maxlength="20" required>
						</div>
					</div>
					<br><br>
					<div class="emailRegister">
						<label class="labelInput" for="email">Adresse mail</label>
						<input class="emailInput" type="email" name="email" id="email" required>
					</div>
					<br><br>
					<div class="passwordRegister">
						<label class="passwordInput" for="mdp">Mot de passe</label>
						<input class="passwordInput" type="password" name="mdp" id="mdp" required>
					</div>
					<br><br>
					<div class="sexeBirth">
						<div class="radioGender">
							<label class="sexeTitle">SEXE</label>
							<input class="radioSexe" type="radio" name="sexe" value="Male"> Homme
							<input class="radioSexe" type="radio" name="sexe" value="Female"> Femme
						</div>
						<br><br>

						<div class="birthDate">
						<label class="birthTitle sexeBirth" for="birth">Date de naissance</label>
						<input class="sexeBirth" type="date" name="date" id="date" required>
						</div>
					</div>
					<br><br>


					<div class="conditionContainer">
						<input type="checkbox" name="conditionUser" required> </label>
						<label class="conditionUser">J'ACCEPTE LES CONDITIONS D'UTILISATIONS

					</div>



					<br><br>
					<div class="registButtonContainer">
						<input class="registButton" type="submit" value="S'inscrire">
					</div>
				</form>

</body>

</html>