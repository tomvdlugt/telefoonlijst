<?php
namespace nl\mondriaan\ict\ao\telefoonlijst\models;

class BezoekerModel 
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
    }
    
    public function isPostLeeg()
    {
        return empty($_POST);
    }
    
    private function startSessie()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
    public function getContacten()
    {
       $aid= filter_input(INPUT_GET,'aid',FILTER_VALIDATE_INT);
       
       if($aid===null)
       {
           return REQUEST_FAILURE_DATA_INCOMPLETE;
       }
       if($aid===false)
       {
           return REQUEST_FAILURE_DATA_INVALID;
       }      
       
       $sql = "SELECT * FROM `contacten` WHERE `contacten`.`afdelings_id`= :aid  ORDER BY achternaam";
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindParam(':aid',$aid);
       $stmnt->execute();
       $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Contact');    
       return $contacten;
    }
    public function getContact()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
           return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
           return REQUEST_FAILURE_DATA_INVALID;
        }      
       
        $sql = "SELECT * FROM `contacten` WHERE `contacten`.`id`= :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id',$id);
        $stmnt->execute();
        $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Contact'); 
        if(empty($contacten))
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        return $contacten[0];
    }
   
    public function getAfdelingen()
    {
       $sql = 'SELECT * FROM `afdelingen` ORDER BY naam';
       $stmnt = $this->db->prepare($sql);
       $stmnt->execute();
       $afdelingen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Afdeling');    
       return $afdelingen;
    }
    
    public function getAfdeling()
    {
       $aid= filter_input(INPUT_GET,'aid',FILTER_VALIDATE_INT);
       
       if($aid===null)
       {
           return REQUEST_FAILURE_DATA_INCOMPLETE;
       }
       if($aid===false)
       {
           return REQUEST_FAILURE_DATA_INVALID;
       }  
       
       $sql = 'SELECT * FROM `afdelingen` WHERE `afdelingen`.`id`= :aid';
       $stmnt = $this->db->prepare($sql);                      
       $stmnt->bindParam(':aid',$aid);
       $stmnt->execute();
       $afdelingen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Afdeling'); 
       if(empty($afdelingen))
       {
            return REQUEST_FAILURE_DATA_INVALID;
       }
       return $afdelingen[0];
    }
    
    public function getDirecteur() 
    {
       $sql = "SELECT * FROM `contacten` WHERE `contacten`.`recht`= 'directeur'";
       $stmnt = $this->db->prepare($sql);
       $stmnt->execute();
       $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Contact');    
       return $contacten[0];
    }
    
    public function controleerInloggen()
    {
        $gn=  filter_input(INPUT_POST, 'gn');
        $ww=  filter_input(INPUT_POST, 'ww');
        
        if ( ($gn!==null) && ($ww!==null) )
        {
             $sql = 'SELECT * FROM `contacten` WHERE `gebruikersnaam` = :gn AND `wachtwoord` = :ww';
             $sth = $this->db->prepare($sql);
             $sth->bindParam(':gn',$gn);
             $sth->bindParam(':ww',$ww);
             $sth->execute();
             
             $result = $sth->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Contact');
             
             if(count($result) === 1)
             {   
                 $this->startSessie();   
                 $_SESSION['gebruiker']=$result[0];
                 return REQUEST_SUCCESS;
             }
             return REQUEST_FAILURE_DATA_INVALID;
        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }
    
    public function getGebruiker()
    {
        if(!isset($_SESSION['gebruiker']))
        {
            return NULL;
        }
        return $_SESSION['gebruiker'];
    }
}