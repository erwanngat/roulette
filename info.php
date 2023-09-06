<?php
require_once('BDD_Manager.php');

$user = $_SESSION['joueur_id'];

$bdd = initialiseConnexionBDD();

$sql = $bdd->prepare('SELECT date, mise, gain FROM roulette_partie WHERE joueur = ?'); 
$sql->execute(array($user));


while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    $date = $row['date'];
    $mise = $row['mise'];
    $gain = $row['gain'];

    echo "Date : $date, Mise : $mise, Gain : $gain<br>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
</head>
<body>
    
</body>
</html>