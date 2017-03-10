<?php
    namespace nl\mondriaan\ict\ao\telefoonlijst\controls;
    
    use nl\mondriaan\ict\ao\telefoonlijst\models as MODELS;
    use nl\mondriaan\ict\ao\telefoonlijst\view as VIEW;
    use nl\mondriaan\ict\ao\telefoonlijst\utils\Foto as FOTO;
    
class SecretaresseController  
{
    private $action;
    private $control;
    private $view;
    private $model;
    
    public function __construct($control,$action)
    {
        $this->control = $control;
        $this->action = $action;

        $this->view=new VIEW\View();     
        $this->model = new MODELS\SecretaresseModel($control, $action);
        
        $isGerechtigd = $this->model->isGerechtigd();
        
        if($isGerechtigd!==true)
        {
            $this->model->uitloggen();
            $this->forward('default','bezoeker');
        }
    }

    /**
    * execute vertaalt de action variable dynamisch naar een handler van de specifieke controller.
    * als de handler niet bestaat wordt de default als action ingesteld en
    * wordt de taak overgedragen aan de defaultAction handler. defauktAction bestaat altijd wel
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
    
    private function uitloggenAction()
    {
        $this->model->uitloggen();
        $this->forward('default','bezoeker');
    }
  
    private function defaultAction()
    {
       $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        $contacten = $this->model->getContacten();
        $this->view->set('contacten', $contacten);
    }
    
    private function beheerAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        $contacten = $this->model->getContacten();
        $this->view->set('contacten', $contacten);
        $afdelingen = $this->model->getAfdelingen();
        $this->view->set('afdelingen', $afdelingen);
    }
    
    private function addAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Vul gegevens in van een nieuwe medewerker");          
        }
        else
        {   
            $result=$this->model->addContact();
            switch($result)
            {
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Foto te groot. Kies kleinere foto.");  
                    $this->view->set('form_data',$_POST);
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. foto niet van jpg, gif of png formaat.");  
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Niet alle vereiste data ingevuld.");  
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Er is foutieve data ingestuurd (bv gebruikersnaam bestaat al).");  
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap", "Contact is toegevoegd."); 
                    $this->forward("beheer");
                    break;  
            }  
        }
        $afdelingen = $this->model->getAfdelingen();
        $this->view->set('afdelingen',$afdelingen);
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    private function deleteAction()
    {
        $result = $this->model->deleteContact();
        switch($result)
        {
            case REQUEST_FAILURE_DATA_INCOMPLETE:
                $this->view->set('boodschap','geen te verwijderen contact gegeven, dus niets verwijderd');
                break;
            case REQUEST_FAILURE_DATA_INVALID:
                $this->view->set('boodschap','te verwijderen contact bestaat niet');
                break;
            case REQUEST_NOTHING_CHANGED:
                 $this->view->set('boodschap','Er is niets verwijderd reden onbekend.');
                break;
            case REQUEST_SUCCESS:
                $this->view->set('boodschap','Contact verwijderd.');
                break;
        }
        $this->forward('beheer');
    }
    
    private function resetwwAction(){
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('secretaresse',$gebruiker);
        $result = $this->model->resetWw();
        switch($result)
        {
            case REQUEST_FAILURE_DATA_INCOMPLETE:
                $this->view->set('boodschap','geen te resetten contact gegeven, dus niets verwijderd');
                break;
            case REQUEST_FAILURE_DATA_INVALID:
                $this->view->set('boodschap','te resetten contact bestaat niet');
                break;
            case REQUEST_NOTHING_CHANGED:
                 $this->view->set('boodschap','Er is niets veranderd, het wachtwoord is het standaard wachtwoord.');
                break;
            case REQUEST_SUCCESS:
                $this->view->set('boodschap','Wachtwoord gereset.');
                break;
        }
        $this->forward('beheer');
    }
    
    private function fotoAction(){
        
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Wijzig hier je foto");
        }
        else{
            $afbeeldingInfo = FOTO::isAfbeeldingGestuurd();
            switch($afbeeldingInfo)
            {
                case IMAGE_NOTHING_UPLOADED:
                    $this->view->set("boodschap","er is helemaal geen upload gedaan!!");
                    break;
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("boodschap","het door juow ge-uploade bestand is te groot!!");
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("boodschap","het door jou geuploade bestand is geen afbeelding (jpg, png, gif)!!");
                    break;
                case IMAGE_SUCCES:
                    $result = $this->model->wijzigFoto();
                    switch($result)
                    {
                        case REQUEST_NOTHING_CHANGED:
                        case IMAGE_FAILURE_SAVE_FAILED:
                            $this->view->set('boodschap','er is een serverfout, de afbeelding kan niet opgeslagen worden.');
                            break;
                        case REQUEST_SUCCESS:
                            $this->view->set('boodschap','de foto is succesvol gewijzigd');
                            $this->forward ('default');
                    }
                    break;
            }
        }
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    private function anwAction()
    {   
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Wijzig hier je  gegevens");
        }
        else
        {
            $result = $this->model->wijzigAnw();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','wijziging gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","De gegevens waren incompleet. Vul compleet in!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap","gebruikersnaam is al in gebruik, kies een andere waarde.");
                    break;
            }   
        }
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    private function wwAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Wijzig hier je wachtwoord");
        }
        else
        {
            $result = $this->model->wijzigWw();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','wijziging wachtwoord gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap","nieuwe wachtwoord niet identiek of oude wachtwoord fout. Poog opnieuw!");
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","Niet alle velden ingevuld!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
            } 
        }
    }
}