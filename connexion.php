<?php 

$login_valide = "erwann";
$mdp_valide = "oh";

if (isset($_POST['nom']) && isset($_POST['mdp'])){


    if ($login_valide == $_POST['nom'] && $mdp_valide == $_POST['mdp']) {

        try{
            $bdd = new PDO('mysql:host=localhost;dbname=roulette;charset=utf8',
            'root',
            '');
        }
        catch (Exception $e){
            die('Erreur:'. $e->getMessage());
        }
        
        $requete = 'SELECT * FROM joueur;';
        $reponse = $bdd->query($requete);

        while($data = $reponse->fetch()){
            echo'Nom:'.$data['nom'];
        }

        $reponse->closeCursor();

        session_start();

        $_SESSION['login'] = $_POST['nom']; 
        echo $_SESSION['login'];

        header ('location: roulette.php');
}
}

if(isset($_SESSION['login'])){
    header('location: roulette.php');
}

if(isset($_GET['deco'])){

    session_start ();

    session_unset ();

    session_destroy ();

    header ('location: connexion.php');
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>test</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <h1>Le jeux de la roulette</h1>

<div class="corps">
<form action="connexion.php" method="post">
 <p>Identifiant : <input type="text" name="nom" /></p>
 <p>Mot de passe : <input type="password" name="mdp" /></p>
 </div>
 <div class="conn">
 <p><input type="submit" value="Se connecter"/></p>
</form>
</div>

<div class="inscr">
<a href="inscription.php">
<button>Inscription</button>
</a>
</div>
</body>
</html>

