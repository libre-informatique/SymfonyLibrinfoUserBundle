<?php

namespace Librinfo\UserBundle\Entity\Traits;

use DateTime;
use Librinfo\UserBundle\Entity\User;

trait Traceable
{
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
    public function setCreatedBy(UserInterface $createdBy)
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
    public function setUpdatedBy(UserInterface $updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}
