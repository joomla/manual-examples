<?php
namespace My\Component\Exampleform\Site\Controller;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

class ExampleformController extends BaseController
{
    public function submit($key = null, $urlVar = null)
    {
        // Check that this HTTP POST has come from our form
        // checkToken checks the token is valid and exits if it's not right
        $this->checkToken();

        $app   = Factory::getApplication();
        $model = $this->getModel('exampleform');
        $form = $model->getForm(null, false);
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        // name of array 'jform' must match 'control' => 'jform' line in the model code
        $data  = $this->input->post->get('jform', array(), 'array');

        // This is validate() from the FormModel class, not the Form class
        // FormModel::validate() calls both Form::filter() and Form::validate() methods
        $validData = $model->validate($form, $data);

        if ($validData === false)
        {
            $errors = $model->getErrors();

            foreach ($errors as $error)
            {
                if ($error instanceof \Exception)
                {
                    $app->enqueueMessage($error->getMessage(), 'warning');
                }
                else
                {
                    $app->enqueueMessage($error, 'warning');
                }
            }

            // Save the form data in the session, using a unique identifier
            $app->setUserState('com_exampleform.example', $data);
            
            // Redirect back to the form
            $this->setRedirect(Route::_('index.php?option=com_exampleform', false));
        }
        else
        {
            $app->enqueueMessage("Data successfully validated", 'notice');
            // Clear the form data in the session
            $app->setUserState('com_exampleform.example', null);
            
            // Usually Joomla uses the Post-Request-Get pattern and the code
            // would enqueue a success message and redirect to an appropriate page
            // Here instead we use the ExampleformReturn View to allow you to 
            // inspect the variables more easily
            $view = $this->getView('exampleformReturn', 'html');
            $view->setData($data, $validData);
            $view->display();
        }


    }
}