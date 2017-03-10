<?php
    namespace nl\mondriaan\ict\ao\telefoonlijst\controls;
    
    use nl\mondriaan\ict\ao\telefoonlijst\models as MODELS;
    use nl\mondriaan\ict\ao\telefoonlijst\view as VIEW;

class BezoekerController  
{
    private $action;
    private $control;
    private $view;
    private $model;
    
    public function __construct($control,$action, $message=NULL)
    {
        $this->control = $control;
        $this->action = $action;

        $this->view=new VIEW\View();
        $this->model = new MODELS\BezoekerModel($control, $action);
        
        if(!empty($message))
        {
            $this->view->set('boodschap',$message);
        }         
    }

    /**
    * execute vertaalt de action variable dynamisch naar een handler van de specifieke controller.
    * als de handler niet bestaat wordt de default als action ingesteld en
    * wordt de taak overgedragen aan de defaultAction handler. defaultAction bestaat altijd wel.
    */
    public function execute() 
    {
        $opdracht = $this->action.'Action';
        if(!method_exists($this,$opdracht))
        {
            $opdracht = 'defaultAction';
            $this->action = 'default';
        }
        $this->$opdracht();
        $this->view->setAction($this->action);
        $this->view->setControl($this->control);
        $this->view->toon();
    }
    
    private function forward($action, $control=null)
    {
        if($control!==null)
        {
            $klasseNaam = __NAMESPACE__.'\\'.ucFirst($control).'Controller';
            $controller = new $klasseNaam($control,$action);
        }
        else 
        {
            $this->action = $action;
            $controller = $this;
        }
        $controller->execute();
        exit();
    }
    
    private function inloggenAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Vul uw gegevens in");
        }
        else
        {   
            $resultInlog=$this->model->controleerInloggen();
            switch($resultInlog)
            {
                case REQUEST_SUCCESS:
                     $this->view->set("boodschap","Welkom op de beheers applicatie. Veel werkplezier");
                     $recht = $this->model->getGebruiker()->getRecht();
                     $this->forward("default", $recht);
                     break;
                case REQUEST_FAILURE_DATA_INVALID:
                     $this->view->set("boodschap","Gegevens kloppen niet. Probeer opnieuw."); 
                     break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                     $this->view->set("boodschap","niet alle gegevens ingevuld");
                     break;
            }
        }
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
    }
    
    private function defaultAction()
    {
       $afdelingen=$this->model->getAfdelingen();
       $this->view->set("afdelingen",$afdelingen);
       $directeur = $this->model->getDirecteur();
       $this->view->set("directeur",$directeur);
    }
    
    private function afdelingAction()
    {
       $directeur = $this->model->getDirecteur();
       $this->view->set("directeur",$directeur);
       
       $afdelingen=$this->model->getAfdelingen();
       $this->view->set("afdelingen",$afdelingen);
       
       $contacten = $this->model->getContacten();
       if($contacten===REQUEST_FAILURE_DATA_INCOMPLETE || $contacten===REQUEST_FAILURE_DATA_INVALID)
       {          
               $this->view->set("boodschap","opvragen contacten is niet gelukt!");
               $this->forward("default", "bezoeker");
       }
       $this->view->set("contacten",$contacten);
              
       $team = $this->model->getAfdeling();
       if($team===REQUEST_FAILURE_DATA_INCOMPLETE || $team===REQUEST_FAILURE_DATA_INVALID)
       {          
               $this->view->set("boodschap","opvragen afdeling is niet gelukt!");
               $this->forward("default", "bezoeker");
       }
       $this->view->set("team",$team);              
    }
    
    private function detailsAction()
    {
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $contact = $this->model->getContact();
        if($contact===REQUEST_FAILURE_DATA_INCOMPLETE || $contact===REQUEST_FAILURE_DATA_INVALID)
        {          
               $this->view->set("boodschap","opvragen persoon is niet gelukt!");
               $this->forward("default", "bezoeker");
        }
        $this->view->set("contact",$contact);
    }
    
    private function directeurAction()
    {
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
        $this->view->set("contact",$directeur);
    }
}