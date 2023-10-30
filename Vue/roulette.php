<header id="head">
	<h2 class="alert alert-warning">Jeu de la roulette</h2>
</header>
<br>
<?php 
if($message_erreur != '')
		echo "<div class=\"alert alert-danger errorMessage\">$message_erreur</div>";

if($message_info != '') {
	echo "<div class=\"alert alert-info infoMessage\">$message_info</div>";
	if($gagne) {
		echo "<div class=\"alert alert-success resultMessage\">$message_resultat</div>";
	} else {
		echo "<div class=\"alert alert-danger resultMessage\">$message_resultat</div>";
	}
}
?>
<div id="intro">
	<h3><?= htmlspecialchars($_SESSION['joueur_nom']) ?></h3>
	<h4><?= htmlspecialchars($_SESSION['joueur_argent']) ?> €</h4>
</div>
<br>
	<form method="get" action="index.php" id="formJeu">
	<table id="rouletteTable">

		<tr class="bborder">
			<td colspan="3"><input type="number" min="1" max="<?= $_SESSION['joueur_argent'] ?>" name="mise" placeholder="Votre mise" /></td>
		</tr>
		
		<tr class="bborder">
			<td id="textSliderNombre">Miser sur un nombre</td>
			<td>
			<!-- Rounded switch -->
			<label class="switch">
			  <input type="checkbox">
			  <span class="slider round" id="selecteurJeu"></span>
			</label> 
			</td>
			
			<td id="textSliderParite">Miser sur la parité</td>
		</tr>

		<tr class="bborder" id="trJeu">
			<td id="tdJeuNombre" colspan="3">
			<div class="blockJeu">
				Choisissez votre nombre<br><br>
				<input type="number" name="numero" min="1" max="36" />
			</div>
			</td>
			<td id="tdJeuParite" colspan="3">
			<div class="blockJeu">
				Choisissez la parité<br><br>
				
				<input id="btnRadioPair" class="checkBoxParite" name="parite" value="pair" type="radio">
				<label for="btnRadioPair" id="labelRadioPair" class="labelRadioParite">Pair</label>
				<input id="btnRadioImpair" class="checkBoxParite" name="parite" value="impair" type="radio">
				<label for="btnRadioImpair" id="labelRadioImpair" class="labelRadioParite">Impair</label>
			   
			</div>
			</td>
		</tr>

		<tr>
			<td colspan="3"><input type="submit" name="btnJouer" class="btn btn-success" value="Jouer" /></td>
		</tr>
		<tr>
			<td colspan="3"><a href="index.php?deco" id="quitButton" class="btn btn-danger">Quitter</a></td>
		</tr>
	</table>
	</form>

	<?php if($res){?>
		<table id='stat'>
			<tr id='statTr'>
				<th id='statTh'>Date</th>
				<th id='statTh'>Mise</th>
				<th id='statTh'>Gain</th>
			</tr>
			<?php foreach ($res as $row) { ?>
			<tr <?php if ($row['gain'] == 0) { echo 'class="red-row"'; } elseif ($row['gain'] > 0) { echo 'class="green-row"'; } ?>>
				<td id='statTd'><?php 
					$timestamp = strtotime($row['date']);
					$date = new DateTime();
					$date->setTimestamp($timestamp);
					$date->setTimezone(new DateTimeZone('Europe/Paris'));
					$fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Paris');
					$date_formatee = $fmt->format($date);
					$date_formatee = str_replace("heure d’été d’Europe centrale", '', $date_formatee);
					echo $date_formatee;
					?></tdt>
				<td id='statTd'><?php echo $row['mise']; ?></tdt>
				<td id='statTd'><?php echo $row['gain']; ?></tdt>
			</tr>
			<?php } ?>
		</table>
	<?php
	}?>
