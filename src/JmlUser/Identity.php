<?php
namespace JmlUser;

use ZfcRbac\Identity\StandardIdentity;

use Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class Identity extends StandardIdentity implements ServiceLocatorAwareInterface
{
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
        if (empty($this->roles)) {
            $this->roles = array('guest');
        }
        return $this->roles;
    }
}
