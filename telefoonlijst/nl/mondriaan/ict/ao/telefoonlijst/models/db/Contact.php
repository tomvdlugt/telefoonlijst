<?php
namespace nl\mondriaan\ict\ao\telefoonlijst\models\db;
class Contact 
{
    private $id;
    private $gebruikersnaam;
    private $wachtwoord;
    private $voorletter;
    private $tussenvoegsel;
    private $achternaam;
    private $intern;
    private $extern;
    private $email;
    private $recht;
    private $foto;
    private $afdelings_id;
    private $afdelings_naam;
    private $afdelings_afkorting;
    
    
    public function __construct()
    {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
        $this->afdelings_id = filter_var($this->afdelings_id,FILTER_VALIDATE_INT);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAfdelings_id()
    {
        return $this->afdelings_id;
    }
    public function getAfdelings_naam(){
        return $this->afdelings_naam;
    }
    public function getAfdelings_afkorting()
    {
        return $this->afdelings_afkorting;
    }

    public function getVoorletter()
    {
        return $this->voorletter;
    }
    
    public function getTussenvoegsel()
    {
        return $this->tussenvoegsel;
    }
    
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    public function getNaam()
    {
        return "$this->voorletter. $this->tussenvoegsel $this->achternaam";
    }
    
    public function getIntern()
    {
        return $this->intern;
    }
    
    public function getExtern()
    {
        return $this->extern;
    }
    
    public function getEmail()
    {
        return $this->email;
    } 
    
     public function getRecht()
    {
        return $this->recht;
    } 
    public function getGebruikersnaam()
    {
        return $this->gebruikersnaam;
    }
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }
    
    public function getFoto() {
        return $this->foto;
    }
}
