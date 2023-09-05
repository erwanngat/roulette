
<?php
try{
        $bdd = new PDO('mysql:host=localhost;dbname=roulette;charset=utf8',
        'root',
        '');
    }
    catch (Exception $e){
        die('Erreur:'. $e->getMessage());
    }

$name = 'SELECT * FROM joueur;';
$rep = $bdd->query($name);

while($data = $rep->fetch()){
    echo 'Nom:', $data['nom'];
    echo 'mdp', $data['mdp'];

}




$sql = "INSERT INTO 'joueur'('id', 'nom', 'mdp', 'argent') VALUES (NULL, moi, test, '500')";



$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $bdd->prepare("INSERT INTO joueur (id,  nom, mdp, argent) VALUES (:id, :nom, :mdp, :argent)");
 
$stmt -> bindParam(':id', $_POST["id"]);
$stmt -> bindParam(':nom', $_POST["nom"]);
$stmt -> bindParam(':mdp', $_POST["mdp"]);
$stmt -> bindParam(':argent', '500');
 
$stmt->execute();

INSERT INTO `joueur` (`id`, `nom`, `mdp`, `argent`) VALUES
(NULL, $_POST["nom"], $_POST["mdp"], 500);