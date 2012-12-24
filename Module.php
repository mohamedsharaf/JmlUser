<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace JmlUser;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManagerInterface;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'JmlUser' => __DIR__ . '/src/JmlUser',
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'jmluser_identity' => '\JmlUser\Identity',
            ),
            'factories' => array(
                'zfcuser_user_mapper' => function ($sm) {
                    $mapper = new \JmlUser\Mapper\User();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new \JmlUser\Entity\User());
                    $mapper->setHydrator(new \ZfcUser\Mapper\UserHydrator());
                    return $mapper;
                },
            ),
        );
    }

}
