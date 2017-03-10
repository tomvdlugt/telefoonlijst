<?php
namespace nl\mondriaan\ict\ao\telefoonlijst\models\db;

class Afdeling {
    private $id;
    private $omschrijving;
    private $foto;
    private $afkorting;
    private $naam;
    
    public function __construct()
    {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getOmschrijving() 
    {
        return $this->omschrijving;
    }
    
    public function getAfkorting()
    {
        return $this->afkorting;
    }
    
    public function getFoto()
    {
        return $this->foto;
    }
    
    public function getNaam()
    {
        return $this->naam;
    }
}