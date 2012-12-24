<?php
namespace JmlUser\Entity;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class User extends \ZfcUser\Entity\User
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

    /**
     * @return \JmlUser\Identity
     */
    public function setRbacIdentity()
    {
        $identity = $this->_sm->get('jmluser_identity');
        return $identity;
    }

}
