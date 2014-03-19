<?php
namespace Leads\V2\Rest\Template;

class TemplateEntity
{ 
    private $market_id;
    private $templates;

    public function __construct($market_id)
    {
        $this->market_id = $market_id; 
    }

    public function getMarketId()
    {
        return $this->market_id;
    }

    public function getTemplates()
    {
        return $this->templates;
    }
    
    public function setTemplates($records)
    {
         $this->templates = $records;
    }
}
