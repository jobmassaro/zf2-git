<?php
namespace Leads\V2\Rest\Languages;

class LanguagesEntity
{ 
    private $login_name;
    private $languages;

    public function __construct($login_name)
    {
        $this->$login_name = $login_name; 
    }

    public function getLanguageId()
    {
        return $this->$login_name;
    }

    public function getLanguages()
    {
        return $this->$languages;
    }
    
    public function setLanguages($records)
    {
         $this->$languages = $records;
    }
}
