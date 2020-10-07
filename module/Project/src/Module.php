<?php
namespace Project;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ProjectTable::class => function($container) {
                    $tableGateway = $container->get(Model\ProjectTableGateway::class);
                    return new Model\ProjectTable($tableGateway);
                },
                Model\ProjectTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Project());
                    return new TableGateway('projects', $dbAdapter, null, $resultSetPrototype);
                },
                Model\DepartmentTable::class => function($container) {
                    $tableGateway = $container->get(Model\DepartmentTableGateway::class);
                    return new Model\DepartmentTable($tableGateway);
                },
                Model\DepartmentTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Department());
                    return new TableGateway('departments', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ProjectController::class => function($container) {
                    return new Controller\ProjectController(
                        $container->get(Model\ProjectTable::class)
                    );
                },
                Controller\DepartmentController::class => function($container) {
                    return new Controller\DepartmentController(
                        $container->get(Model\DepartmentTable::class)
                    );
                },
            ],
        ];
    }

}

?>