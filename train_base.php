<!DOCTYPE html>
<html>
<head>
	<title>Formulaire d'inscription</title>
</head>
<body>
	<h1>Inscription</h1>
	<?php

	try {
	    $conn = new PDO('mysql:host=localhost;dbname=roulette;charset=utf8',
        'root',
        '');
	    // Configuration de PDO pour générer des exceptions en cas d'erreur
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // Affichage d'un message de connexion réussie si tout s'est bien passé
	    echo "Connexion réussie à la base de données";
	} catch(PDOException $e) {
	    // Affichage d'un message d'erreur si la connexion a échoué
	    echo "Erreur de connexion à la base de données: " . $e->getMessage();
	}

	// Vérification si le formulaire a été soumis
	if(isset($_POST['nom']) && isset($_POST['mdp'])) {
		// Récupération des données du formulaire HTML
		$nom = $_POST['nom'];
		$mdp = $_POST['mdp'];

		// Préparation de la requête SQL
		$sql = "INSERT INTO joueur (nom, mdp) VALUES (:nom, :mdp)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':nom', $nom);
		$stmt->bindParam(':mdp', $mdp);

		// Exécution de la requête SQL
		try {
		    $stmt->execute();
		    // Affichage d'un message de réussite si tout s'est bien passé
		    echo "Données envoyées avec succès à la base de données";
		} catch(PDOException $e) {
		    // Affichage d'un message d'erreur si l'envoi a échoué
		    echo "Erreur lors de l'envoi des données à la base de données: " . $e->getMessage();
		}
	}

	// Fermeture de la connexion à la base de données
	$conn = null;
	?>
	<form method="POST">
		<label for="nom">Nom:</label>
		<input type="text" id="nom" name="nom" required>
		<br>
		<label for="mdp">Mot de passe:</label>
		<input type="password" id="mdp" name="mdp" required>
		<br>
		<input type="submit" value="S'inscrire">
	</form>
</body>
</html>