<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Library;

return array(
    'controllers' => array(
        'invokables' => array(
            'Library\Controller\Book' => 'Library\Controller\BookController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'book' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/book/[:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9]*', 
                        'subdomain' => '[0-9]+', 
                    ),
                    'defaults' => array(
                        'controller'    => 'Library\Controller\Book',
                        'action' => 'list',
                    )
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'library_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/'.__NAMESPACE__.'/Entity',
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => 'library_entity',
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
