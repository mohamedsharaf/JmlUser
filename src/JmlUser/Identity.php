<?php
namespace JmlUser;

use ZfcRbac\Identity\IdentityInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Identity implements IdentityInterface, ServiceLocatorAwareInterface
{
    protected $_roles = array();

    /** @var ServiceLocatorInterface */
    protected $_sm;

    public function setServiceLocator(ServiceLocatorInterface $sm)
    {
        $this->_sm = $sm;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->_sm;
    }

    public function getRoles()
    {
        if (empty($this->_roles)) {
            $auth = $this->_sm->get('zfcuser_auth_service');
            if ($auth->hasIdentity()) {
                $this->_roles = array('admin');
            }
            else {
                $this->_roles = array('guest');
            }
        }
        return $this->_roles;
    }
}

