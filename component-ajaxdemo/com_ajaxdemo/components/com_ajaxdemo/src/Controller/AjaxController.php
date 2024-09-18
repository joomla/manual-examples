<?php
namespace My\Component\Ajaxdemo\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class AjaxController extends BaseController
{
    public function divide()
    {
        // if you're using Joomla MVC then the Application instance is passed into the BaseController constructor
        // and stored as an instance variable $app which can be used your component Controllers
        $input = $this->app->input; 

        $a = $input->get("a", 0, "float");
        $b = $input->get("b", 0, "float");
        
        // Generate some enqueued messages which will be displayed using the js code
        $this->app->enqueueMessage("Enqueued notice", "notice");
        $this->app->enqueueMessage("Enqueued warning", "warning");
        
        try 
        {
            $result = $this->_divide($a, $b);
            echo new JsonResponse($result, "It worked!");
        }
        catch (\Exception $e)
        {
            echo new JsonResponse($e);
        }
    }
    
    private function _divide($a, $b)  
    {
        if ($b == 0)
        {
            throw new \Exception('Division by zero!');
        }
        return $a/$b;
    }
}