<?php
namespace Leads\V2\Rest\Management;

use Zend\Stdlib\ArraySerializableInterface;

class ManagementEntity implements ArraySerializableInterface
{
    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     * @return void
     */
    public function exchangeArray(array $array)
    {
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
    }
    
    
    private $open_cookie_id;
    private $text;
    private $who;

    public function __construct(array $entity = null)
    {
        if ($entity !== null && is_array($entity)) {
            $this->open_cookie_id = $entity['open_cookie_id'];
            $this->text = $entity['text'];
            $this->who = $entity['who'];
        }
    }

    public function getOpenCookieId()
    {
        return $this->open_cookie_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getWho()
    {
        return $this->who;
    }
    
}
