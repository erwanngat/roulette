<?php

    session_start();


    if (isset($_POST['nom']) && isset($_POST['mdp'])){

        $_SESSION['login'] = $_POST['nom']; 
          header('location: roulette.php');
    }

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=roulette;charset=utf8',
        'root',
        '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e){
        die('Erreur:'. $e->getMessage());
    }
    

    if (isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['argent'])){

        $nom = $_POST['nom'];
        $mdp = $_POST['mdp'];
        $argent = $_POST['argent'];

        $sql = "INSERT INTO joueur (nom, mdp, argent) VALUES (:nom, :mdp, :argent)";
		$stmt = $bdd->prepare($sql);
		$stmt->bindParam(':nom', $nom);
		$stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':argent', $argent);

        try {
		    $stmt->execute();
		   
		}
    catch(Exception $e) {
        
        echo "Erreur lors de l'envoi des données à la base de données: " . $e->getMessage();
    }
    }

$bdd = null;
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>test</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>

<div class="corps">
<form action="inscription.php" method="post">
 <p>Identifiant : <input type="text" name="nom" /></p>
 <p>Mot de passe : <input type="password" name="mdp" /></p>
 <label for="argent">Argent:</label>
<input type="number" id="argent" name="argent" value="500" required>

 <p><input type="submit" value="S'inscrire" action="roulette.php"></p>
</a>
</form>
</div>

</body>
</html>