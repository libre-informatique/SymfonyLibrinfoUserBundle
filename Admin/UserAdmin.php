<?php

namespace Librinfo\UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\CoreAdmin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserAdmin extends CoreAdmin
{
    /**
     * @var UserPasswordEncoder
     */
    private $securityPasswordEncoder;

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('username')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('lastLogin')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('username')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('enabled','checkbox',['label'=>'Enabled'])
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('plainPassword','repeated',[
                "required" => false,
                "translation_domain" => 'FOSUserBundle'
            ])
            ->add('lastLogin')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt');

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('lastLogin')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt');
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
