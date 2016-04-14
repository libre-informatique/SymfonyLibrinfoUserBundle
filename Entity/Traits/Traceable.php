<?php

namespace Librinfo\UserBundle\Entity\Traits;

use DateTime;
use Librinfo\UserBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

trait Traceable
{
    use \Librinfo\DoctrineBundle\Entity\Traits\Traceable;
    
    /**
     * @var UserInterface
     */
    private $createdBy = null;

    /**
     * @var UserInterface
     */
    private $updatedBy = null;

    /**
     * @return UserInterface
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param UserInterface $createdBy
     *
     * @return Traceable
     */
    public function setCreatedBy(UserInterface $createdBy = NULL)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param UserInterface $updatedBy
     *
     * @return Traceable
     */
    public function setUpdatedBy(UserInterface $updatedBy = NULL)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}
