<?php

namespace Librinfo\UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\UserAdmin as USRADM;

class UserAdmin extends USRADM
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('password')
            ->add('last_login')
            ->add('expires_at')
            ->add('confirmation_token')
            ->add('password_requested_at')
            ->add('roles')
            ->add('credentials_expired')
            ->add('credentials_expire_at');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('password')
            ->add('last_login')
            ->add('expires_at')
            ->add('confirmation_token')
            ->add('password_requested_at')
            ->add('roles')
            ->add('credentials_expired')
            ->add('credentials_expire_at')
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
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('password')
            ->add('last_login')
            ->add('expires_at')
            ->add('confirmation_token')
            ->add('password_requested_at')
            ->add('roles')
            ->add('credentials_expired')
            ->add('credentials_expire_at');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('salt')
            ->add('password')
            ->add('last_login')
            ->add('expires_at')
            ->add('confirmation_token')
            ->add('password_requested_at')
            ->add('roles')
            ->add('credentials_expired')
            ->add('credentials_expire_at');
    }
}
