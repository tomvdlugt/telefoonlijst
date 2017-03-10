<?php
namespace nl\mondriaan\ict\ao\telefoonlijst\models;

use nl\mondriaan\ict\ao\telefoonlijst\utils\Foto as FOTO;

class MedewerkerModel 
{
    private $control;
    private $action;
    private $db;
   
    public function __construct($control, $action)
    {   
       $this->control = $control;
       $this->action = $action;
       $this->db = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
       $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
       $this->startSessie();
    }
  
    private function startSessie()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
    
    public function isGerechtigd()
    {
        //controleer of er ingelogd is. Ja, kijk of de gebuiker deze controller mag gebruiken 
        if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
        {
            $gebruiker=$_SESSION['gebruiker'];
            if ($gebruiker->getRecht() == "medewerker")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;     
   }
   
   public function getGebruiker()
   {
       return $_SESSION['gebruiker'];
   }
   
   public function uitloggen()
   {
       $_SESSION = array();
       session_destroy();
   }
   
    function isPostLeeg()
    {
       return empty($_POST);
    }
    
    public function wijzigWw() 
    {
        $ww= filter_input(INPUT_POST,'ww');
        $nww1= filter_input(INPUT_POST,'nww1');
        $nww2= filter_input(INPUT_POST,'nww2');
         
        if($ww===null || $nww1===null || $nww2===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if(empty($nww1)||empty($nww2)||empty($ww))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if($_POST['nww1']!==$_POST['nww2'])
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $hww = $this->getGebruiker()->getWachtwoord();
        
        if($hww!== $ww)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($nww1===$ww)
        {
            return REQUEST_NOTHING_CHANGED;
        }
        
        $id = $this->getGebruiker()->getId();
        $sql = "UPDATE `contacten` SET `contacten`.`wachtwoord` = :nww WHERE `contacten`.`id`= :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':nww', $nww1);
        $stmnt->execute();
        $aantalGewijzigd = $stmnt->rowCount();
        
        if($aantalGewijzigd === 1)
        {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    private function updateGebruiker() 
    {
       $gebruiker_id = $this->getGebruiker()->getId();
       $sql = "SELECT * FROM `contacten` WHERE `contacten`.`id`=:gebruiker_id";
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
       $stmnt->setFetchMode(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Contact');   
       $stmnt->execute();
       $_SESSION['gebruiker']= $stmnt->fetch(\PDO::FETCH_CLASS);
    }
   
   public function wijzigAnw()
    {
        $gebruikersnaam= filter_input(INPUT_POST, 'gn');
        $voorletter=filter_input(INPUT_POST, 'vl');
        $tussenvoegsel=filter_input(INPUT_POST, 'tv');
        $achternaam=filter_input(INPUT_POST, 'an');
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $intern=filter_input(INPUT_POST,'int');
        $extern=filter_input(INPUT_POST,'ext');
        
        if(empty($voorletter)||empty($achternaam)||empty($email)||empty($gebruikersnaam))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE; 
        }
        
        if($email===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $gebruiker_id = $this->getGebruiker()->getId();
        
        $sql="UPDATE `contacten` SET gebruikersnaam=:gebruikersnaam,voorletter=:voorletter"
                . ",tussenvoegsel=:tussenvoegsel,achternaam=:achternaam,"
                 . "extern=:extern,intern=:intern,email=:email where `contacten`.`id`= :gebruiker_id; ";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);        
        $stmnt->bindParam(':voorletter', $voorletter);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':extern', $extern);
        $stmnt->bindParam(':intern', $intern);
        $stmnt->bindParam(':email', $email);     
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd===1)
        {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function wijzigFoto() 
    {    
        $fotoNaam = FOTO::getAfbeeldingNaam();//bedenk een naam voor de foto.
        
        $result = FOTO::slaAfbeeldingOp($fotoNaam);//sla foto op
        if($result === false)
        {
            return IMAGE_FAILURE_SAVE_FAILED;
        }
        $id = $this->getGebruiker()->getId();
        //binding onnodig alle gegevens zijn serverside en niet clientside :-)
        $sql = "UPDATE `contacten` SET `contacten`.`foto`= '$fotoNaam' WHERE `contacten`.`id`= :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd === 1)
        {
            $oudeFoto = $this->getGebruiker()->getFoto();
            $this->updateGebruiker();
            FOTO::verwijderAfbeelding($oudeFoto);
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
}
