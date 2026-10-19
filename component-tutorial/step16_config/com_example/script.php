<?php
use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

\defined('_JEXEC') or die;

return new class () implements ServiceProviderInterface {
  public function register(Container $container)
  {
    $container->set(
      InstallerScriptInterface::class,
      new class (
      $container->get(AdministratorApplication::class),
      $container->get(DatabaseInterface::class)
      ) implements InstallerScriptInterface {
        private AdministratorApplication $app;
        private DatabaseInterface $db;

        public function __construct(AdministratorApplication $app, DatabaseInterface $db)
        {
          $this->app = $app;
          $this->db  = $db;
        }

        public function install(InstallerAdapter $parent): bool
        {
          $this->app->enqueueMessage('Successfully installed.');

          return true;
        }

        public function update(InstallerAdapter $parent): bool
        {
          $this->app->enqueueMessage('Successfully updated.');

          return true;
        }

        public function uninstall(InstallerAdapter $parent): bool
        {
          $this->app->enqueueMessage('Successfully uninstalled.');

          return true;
        }

        public function preflight(string $type, InstallerAdapter $parent): bool
        {
          return true;
        }

        public function postflight(string $type, InstallerAdapter $parent): bool
        {
          $this->setDefaultConfig($this->db);
          return true;
        }

        private function setDefaultConfig(DatabaseInterface $db)
        {
          // Get the existing params from the com_example record in the #__extensions table
          $element = "com_example";
          $query = $db->createQuery();
          $query->select($db->quoteName('params'))
                ->from($db->quoteName('#__extensions'))
                ->where($db->quoteName('element') . ' = :element')
                ->bind(':element', $element);
          $db->setQuery($query);
          $params = $db->loadResult();
          $currentParams = json_decode($params);
          
          // Set up the params to be written to the db, carrying forward any existing values
          $newParams = new \stdClass();
          $newParams->zoom = $currentParams->zoom ?? 10;
          if ($newParams != $currentParams) {
            $params = json_encode($newParams);
            $query = $db->createQuery()
              ->update($db->quoteName('#__extensions'))
              ->set($db->quoteName('params') . ' = :params')
              ->where($db->quoteName('element') . ' = :element')
              ->bind(':params', $params)
              ->bind(':element', $element);
            $db->setQuery($query);
            $result = $db->execute();
            if ($result) {
              $this->app->enqueueMessage('Configuration parameters updated.');
            } else {
              throw new \Exception("Unable to update config params");
            }
          }
        }
      }
    );
  }
};