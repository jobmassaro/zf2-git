<?php
namespace Auth\V2\Rest\Login;

use Zend\Stdlib\ArraySerializableInterface;

class LoginEntity implements ArraySerializableInterface
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
        return new \ArrayObject($this);
    }
    
    
    public $token;
    
    public function __construct(array $entity = null)
    {
        if ($entity !== null && is_array($entity)) {
            $this->token = $entity['token'];
        }
    }
    
    public function getToken()
    {
        return $this->token;
    }
}
