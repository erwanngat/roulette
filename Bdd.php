<?php

class Bdd{
    private bdd $bdd;
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
}