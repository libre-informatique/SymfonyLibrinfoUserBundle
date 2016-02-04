<?php

namespace Librinfo\UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GroupAdminConcrete extends GroupAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $mapper)
    {
        dump('configureListFields');
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $mapper)
    {
        dump('configureFormFields');
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $mapper)
    {
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());
    }
}
