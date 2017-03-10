<?php
namespace nl\mondriaan\ict\ao\telefoonlijst\view;

class View {
    private $control;
    private $action;
    private static $data;
    
    public function __construct() 
    {
        if (!isset(self::$data)) 
        {
            self::$data = array();
        }
    }
    
    public function setControl($control)
    {
        $this->control = $control;
    }
    
    public function setAction($action)
    {
        $this->action = $action;
    }
    
    /**
     * draagt een naam waarde paar over aan de view ter expressie in de template;
     */    
    public function set($naam, $waarde)
    {  
        self::$data[$naam] = $waarde;
    }    
    
    private function getTemplate()
    {
        return str_replace('\\','/',__NAMESPACE__).'/tpls/'.$this->control.'/'.$this->action.".php";
    }
    
    /**
     * draagt de view op zijn template op te halen en met data te vullen.
     */
    public function toon()
    {
        foreach (self::$data as $key =>$value)
        {
            $$key = $value;
        }
        include_once $this->getTemplate();
    }
}


 