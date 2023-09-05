<?php
session_start ();

echo $_SESSION['login'];

if(!isset($_SESSION['login'])){
    header('location: connexion.php');
}


?>



<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>test</title>
    <link rel="stylesheet" href="roulette.css">
</head>
<body>
    <h1>Le jeux de la roulette</h1>

<div class="corps">
<form action="connexion.php" method="post">
 <p>Choisissez votre mise : <input type="number" name="mise" /></p>
 <p>Choisissez votre numero : <input type="number" name="numero" /></p>
 </form>

<form>
<p>Miser sur la parité</p>

<input type="radio" id="pair" name="pari" value="pair"> 
<label for="pair">pair</label>

<input type="radio" id="impair" name="pari" value="impair"> 
<label for="impair">impair</label>

</form>
</div>

<div class="jouer">
<button>jouer</button>
</div>


<div class="deco">
<a href="connexion.php?deco">
<button>Deconnexion</button>
</a>
</div>


</body>
</html>