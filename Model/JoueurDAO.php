<?php

class JoueurDAO {
	private PDO $bdd;
	private string $host = 'localhost';
	private string $dbname = 'roulette';
	private string $username = 'root';
	private string $password = '';
	
	/*
	 * Initialise la connexion à la base de données et renvoie l'objet PDO
	 */
	public function __construct() {
		try {
			$dburl = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $this->host, $this->dbname);
			$this->bdd = new PDO($dburl, $this->username, $this->password);	
		} catch(Exception $e) {
			die('Erreur connexion BDD : '.$e->getMessage());
		}
	}

	/*
	 * Vérifie les informations données par l'utilisateur et le connecte ou non
	 */
	function connecteUtilisateur($utilisateur, $motdepasse) : string {
		$res = '';
		if($this->bdd) {
			$sql = 'SELECT * FROM roulette_joueur WHERE nom = ? AND motdepasse = ?;';
			$query = $this->bdd->prepare($sql);
			$query->execute([$utilisateur, $motdepasse]);
			if($data = $query->fetch()) {
				$_SESSION['joueur_id'] = intval($data['identifiant']);
				$_SESSION['joueur_nom'] = $data['nom'];
				$_SESSION['joueur_argent'] = intval($data['argent']);
			} else {
				$res = 'Utilisateur inconnu ou mot de passe erroné';
			}
		}
		return $res;	
	}

	/**
	 * Ajoute un utilisateur à la base de données
	 */
	public function ajouteUtilisateur($nom, $motdepasse) {
		if($this->bdd) {
			$query = $this->bdd->prepare('INSERT INTO roulette_joueur (nom, motdepasse, argent) VALUES (:t_nom, :t_mdp, 500);');
			$query->execute(array('t_nom' => $nom, 't_mdp' => $motdepasse));
		}
	}

	/**
	 * Met à jour l'argent détenu par un joueur dans la base de données
	 */
	public function majUtilisateur($id_joueur, $argent) {
		if($this->bdd) {
			$query = $this->bdd->prepare('UPDATE roulette_joueur SET argent = :t_argent WHERE identifiant = :t_id;');
			$query->execute(array('t_argent' => $argent, 't_id' => $id_joueur));
		}
	}

}