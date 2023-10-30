<?php 

class Partie{
    private int $identifiant;
    private int $joueur;
    private DateTime $date;
    private int $mise;
    private int $gain;

    public function __construct($id, $j ,$d, $m, $g){
        $this->identifiant=$id;
        $this->joueur=$j;
        $this->date=$d;
        $this->mise=$m;
        $this->gain=$g;
    }

    public function getIdentifiant(){return $this->identifiant;}
    public function getJoueur(){return $this->joueur;}
    public function getDate(){return $this->date;}
    public function getMise(){return $this->mise;}
    public function getGain(){return $this->gain;}

    public function setIdentifiant($id){$this->identifiant=$id;}
    public function setJoueur($j){$this->joueur=$j;}
    public function setDate($d){$this->date=$d;}
    public function setMise($m){$this->mise=$m;}
    public function setGain($g){$this->gain=$g;}
}