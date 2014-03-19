<?php
namespace Leads\V2\Rest\Languages;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Paginator\Adapter\ArrayAdapter;

require_once APPL_PATH .'/welcome/classes/actionsContact.class.php';
require_once  APPL_PATH .'/welcome/classes/Language.class.php';



class LanguagesResource extends AbstractResourceListener
{
    public function __construct(\ArrayObject $tokenProperties = null)
    {
        $this->tokenProperties = $tokenProperties;
        
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
    	
    	
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed            
     */
    public function fetch($id,$data)
    {
    	
    	$languagesMarket = \Language::findByMarket($data['CODMARKET']);
    	
    	if(count($languagesMarket) > 0)
    	{
    		for($cnt=0; $cnt < count($languagesMarket); $cnt++)
    		{
    			$record[] = 
    			array(
    					'languages' =>     						
    					array($languagesMarket[$cnt]['CODLANGUAGE'] => $languagesMarket[$cnt]['NAMELANGUAGE']));
    			
    		}
    	}
    	
    	
        $obj = new LanguagesEntity($id);
        $obj->setLanguages($record);
        return $obj;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
