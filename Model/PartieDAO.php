<?php

class PartieDAO {
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

	/**
	 * Ajoute une partie jouée à la base de données
	 */
	public function ajoutePartie($id_joueur, $date, $mise, $gain) {
		if($this->bdd) {
			$query = $this->bdd->prepare('INSERT INTO roulette_partie (joueur, date, mise, gain) VALUES ( :t_id, :t_date, :t_mise, :t_gain);');
			$query->execute(array('t_id' => $id_joueur, 't_date' => $date, 't_mise' => $mise, 't_gain' => $gain));
		}
	}

	public function getPartie($id_joueur){
		if($this->bdd){
			$res = array();
			$sql = 'SELECT date, mise, gain from roulette_partie where joueur = ?';
			$query = $this->bdd->prepare($sql);
			$query->execute(array($id_joueur));
			if($query){
				while ($row = $query->fetch()) {
					$res[] = $row;
				}
			}

			return $res;
		}
	}
}