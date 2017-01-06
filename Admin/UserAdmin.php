<?php

namespace Librinfo\UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Blast\CoreBundle\Admin\CoreAdmin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserAdmin extends CoreAdmin
{
    /**
     * @var UserPasswordEncoder
     */
    private $securityPasswordEncoder;

    /**
     * @param DatagridMapper $mapper
     */
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        parent::configureDatagridFilters($mapper);
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param ListMapper $mapper
     */
    protected function configureListFields(ListMapper $mapper)
    {
        parent::configureListFields($mapper);
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param FormMapper $mapper
     */
    protected function configureFormFields(FormMapper $mapper)
    {
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param ShowMapper $mapper
     */
    protected function configureShowFields(ShowMapper $mapper)
    {
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    public function preUpdate($object)
    {
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);

        if (array_key_exists('plainPassword', $formData) && $formData['plainPassword'] !== null && strlen($formData['plainPassword']['first']) > 0)
        {
            $object->setPassword($this->securityPasswordEncoder->encodePassword($object, $formData['plainPassword']['first']));
        }
    }

    public function prePersist($object)
    {
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);
        if (array_key_exists('plainPassword', $formData) && $formData['plainPassword'] !== null && strlen($formData['plainPassword']['first']) > 0)
        {
            $object->setPassword($this->securityPasswordEncoder->encodePassword($object, $formData['plainPassword']['first']));
        }
    }

    public function setSecurityPasswordEncoder(UserPasswordEncoder $userPasswordEncoder)
    {
        $this->securityPasswordEncoder = $userPasswordEncoder;
    }
}
