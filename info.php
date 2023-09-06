<?php
require_once('BDD_Manager.php');

$user = $_SESSION['joueur_id'];

$bdd = initialiseConnexionBDD();

$sql = $bdd->prepare('SELECT date, mise, gain FROM roulette_partie WHERE joueur = ?'); 
$sql->execute(array($user));

$totmise = 0;
$totgain = 0;

while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
<table border="1">
    <tr>
        <th>Date de la partie</th>
        <th>Mise de la partie</th>
        <th>Gain de la partie</th>
    </tr>
    <tr>
        <td><?php echo $row['date'];?></td>
        <td><?php echo $row['mise'];?></td>
        <td><?php echo $row['gain'];?></td>
    </tr>
</table>
<?php
$totmise += $row['mise'];
$totgain += $row['gain'];
}
echo "La mise total du joueur est de  $totmise <br>";
echo "Les gains totaux du joueur sont de  $totgain <br>";

$sql = $bdd->prepare('SELECT date FROM roulette_partie Where joueur = ? order by date');
$sql->execute(array($user));

$premier = $sql->fetchColumn();

echo "La première première partie tu joueur à été faite le : $premier <br>" ;

$dateactu = new DateTime();
$datepremier = new DateTime($premier); 

$ancien = $dateactu->diff($datepremier); 

$annees = $ancien->y;
$mois = $ancien->m;
$jours = $ancien->d;

echo "Le joueur a donc fait ça première partie il y a $annees années, $mois mois, $jours jours";


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