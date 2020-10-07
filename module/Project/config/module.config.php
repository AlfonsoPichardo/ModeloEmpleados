<?php

namespace Project;

//  use Projects\Controller\ProjectsController;
use Laminas\Router\Http\Segment;


return [
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'project' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/project[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProjectController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'department' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/project/department[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\DepartmentController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'project' => __DIR__ . '/../view',
            'department' => __DIR__ . '/../view',
        ],
    ],
];

?>