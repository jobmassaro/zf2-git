<?php
namespace Leads\V2\Rest\Feedback;

use Zend\Stdlib\ArraySerializableInterface;

class FeedbackEntity implements ArraySerializableInterface
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
    
    
        
    public $result;
    public $feedback_id;
    
    public function __construct(array $entity = null)
    {
        if ($entity !== null && is_array($entity)) {
            $this->feedback_id = $entity['feedback_id'];
            $this->result = $entity['result'];
        }
    }
    
    public function getResult()
    {
        return $this->result;
    }
    
    public function getFeedbackId()
    {
        return $this->feedback_id;    
    }
}
