<?php 

class Joueur{
    private int $identifiant;
    private string $nom;
    private string $motdepasse;
    private int $argent;


    public function __construct($id, $n, $mdp, $a){
        $this->identifiant=$id;
        $this->nom=$n;
        $this->motdepasse=$mdp;
        $this->argent=$a;
    }

    public function getIdentifiant(){return $this->identifiant;}
    public function getNom(){return $this->nom;}
    public function getMotDePasse(){return $this->motdepasse;}
    public function getArgent(){return $this->argent;}

    public function setIdentifiant($id){$this->identifiant=$id;}
    public function setNom($n){$this->nom=$n;}
    public function setMotDePasse($mdp){$this->motdepasse=$mdp;}
    public function setArgent($a){$this->argent=$a;}
}