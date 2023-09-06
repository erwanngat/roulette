<?php
session_start();

class Bdd{
    private PDO $bdd;
    private string $hote;
    private string $nombase;
    private string $nomut;
    private string $password;

    public function __construct($b, $h, $nb, $nu, $p)
    {
        $this->bdd = $b;
        $this->hote = $h;
        $this->nombase = $nb;
        $this->nomut = $nu;
        $this->password = $p;
    }

    public function getBdd() {return $this->bdd;}
    public function getHote() {return $this->hote;}
    public function getNombase() {return $this->nombase;}
    public function getNomut() {return $this->nomut;}
    public function getPassword() {return $this->password;}

    public function setBdd($b) {$this->bdd = $b;}
    public function setHote($h) {$this->hote = $h;}
    public function setNombase($nb) {$this->nombase = $nb;}
    public function setNomut($nu) {$this->nomut = $nu;}
    public function setPassword($p) {$this->password = $p;}

    public function initialiseConnexionBDD(){
        $this->bdd = null;
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=bdd_roulette;charset=utf8', 
                'root', 
                ''
            );	
        } catch(Exception $e) {
            die('Erreur connexion BDD : '.$e->getMessage());
        }
    
        return $this->bdd;
    }

    public function connectUtilisateur($nu, $p){
        $res = '';
        $bdd = $this->initialiseConnexionBDD();
        if($bdd) {
            $sql = 'SELECT * FROM roulette_joueur WHERE nom = ?';
            $result = $bdd->prepare($sql);
            $result->execute([$nu]);
    
            $data = $result->fetch();
            if($data && password_verify($p, $data['motdepasse'])) {
                $_SESSION['joueur_id'] = intval($data['identifiant']);
                $_SESSION['joueur_nom'] = $data['nom'];
                $_SESSION['joueur_argent'] = intval($data['argent']);
            } else {
                $res = 'Utilisateur inconnu ou mot de passe erroné';
            }
        }
        return $res;
    }

    public function ajouteUtilisateur($nu, $p){
        $bdd = $this->initialiseConnexionBDD();
	    if($bdd) {
		$query = $bdd->prepare('INSERT INTO roulette_joueur (nom, motdepasse, argent) VALUES (:t_nom, :t_mdp, 500);');
		$query->execute(array('t_nom' => $nu, 't_mdp' => password_hash($p, PASSWORD_DEFAULT)));
	    }
    }

    public function ajoutePartie($id_joueur, $date, $mise, $gain) {
        $bdd = $this->initialiseConnexionBDD();
        if($bdd) {
            $query = $bdd->prepare('INSERT INTO roulette_partie (joueur, date, mise, gain) VALUES ( :t_id, :t_date, :t_mise, :t_gain);');
            $query->execute(array('t_id' => $id_joueur, 't_date' => $date, 't_mise' => $mise, 't_gain' => $gain));
        }
    }

    public function majUtilisateur($id_joueur, $argent) {
        $bdd = $this->initialiseConnexionBDD();
        if($bdd) {
            $query = $bdd->prepare('UPDATE roulette_joueur SET argent = :t_argent WHERE identifiant = :t_id;');
            $query->execute(array('t_argent' => $argent, 't_id' => $id_joueur));
        }
    }
}