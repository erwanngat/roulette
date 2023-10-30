<link rel="stylesheet" href="style.css" />
<?php

session_start();
require_once('./Model/PartieDAO.php');
require_once('./Model/JoueurDAO.php');

$module = 'connexion';
$message_erreur = '';
$message_info ='';

if(isset($_POST['btnConnect'])) {
    $message_erreur = '';
    $monPDO = new JoueurDAO();
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
		$message_erreur = $monPDO->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		if($message_erreur == '') {
            $module = "roulette";
		}
	}
}

if(isset($_GET['deco'])) {
	session_destroy();
}

// Vérifie que le bouton du formulaire a été cliqué
if(isset($_POST['btnSignup'])) {
    $message_erreur = '';
    $monPDO = new JoueurDAO();
	// Vérifie que les champs existent et ne sont pas vides
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
		// Appelle des fonctions de BDD_Manager.php pour ajouter l'utilisateur en BDD puis le connecter
		$monPDO->ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		$monPDO->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		// Renvoie l'utilisateur vers le jeu de la roulette
        $module = "roulette";
	} else {
		$message_erreur = 'Il faut remplir les champs!';
	}
}

if(!isset($_SESSION['joueur_nom'])){
	$module = "connexion";
}

if(isset($_GET["inscription"])){
    $module = "inscription";
}

if(isset($_GET["connexion"])){
    $module = "connexion";
}

if(isset($_GET['btnJouer'])) {
    $monPDO = new JoueurDAO();
    $monPDOP = new PartieDAO();

    $message_erreur = '';
    $message_info = '';
    $gagne = false;

	if($_GET['mise'] < 0) {
		$message_erreur = 'La mise doit être positive';
	} else if($_GET['mise'] == 0) {
		$message_erreur = 'Il faut miser de l\'argent ...';
	} else if($_GET['mise'] > $_SESSION['joueur_argent']) {
		$message_erreur = 'On ne mise pas plus que ce qu\'on a ...';
	} else if($_GET['numero'] == 0 && !isset($_GET['parite'])) {
		$message_erreur = 'Il faut miser sur quelquechose!';
	} else {
		$_SESSION['joueur_argent'] -= $_GET['mise'];
		$gain = 0;
		$numero = rand(1, 36);

		$miseJoueur = intval($_GET['mise']);
		$numeroJoueur = intval($_GET['numero']);
		$message_info = "La bille s'est arrêtée sur le $numero! ";
		if($_GET['numero']!= "") {
			$message_info .= "Vous avez misé sur le ".$numeroJoueur."!";
			if($numeroJoueur == $numero) {
				$message_resultat = "Jackpot! Vous gagnez ". $miseJoueur*35 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*35;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "Raté!";
			}
		} else {
			$message_info .= "Vous avez misé sur le fait que le résultat soit ".$_GET['parite'];
			$parite = $numero%2 == 0 ? 'pair' : 'impair';
			if($parite == $_GET['parite']) {
				$message_resultat = "Bien joué! Vous gagnez ". $miseJoueur*2 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*2;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "C'est perdu, dommage!";
			}
		}
		$monPDO->majUtilisateur($_SESSION['joueur_id'], $_SESSION['joueur_argent']);
		$monPDOP->ajoutePartie($_SESSION['joueur_id'], date('Y-m-d h:i:s'), $_GET['mise'], $gain);
		$module = 'roulette';
	}
}

if($module == "connexion"){
	$nom_fenetre = 'connexion';
}else if($module == "inscription"){
	$nom_fenetre = 'inscription';
}else if($module == "roulette"){
	$nom_fenetre = 'roulette';
}

include 'Vue/header.php';

if($module == "connexion"){
    include('./Vue/connexion.php');
}else if($module == "inscription"){
    include('./Vue/inscription.php');
}else if($module == "roulette"){
	$monPDOPARTIE = new PartieDAO();
	$res = $monPDOPARTIE->getPartie($_SESSION['joueur_id']);
	setlocale(LC_TIME, 'fr_FR.utf8');
    include('./Vue/roulette.php');
}

include 'Vue/footer.php';
