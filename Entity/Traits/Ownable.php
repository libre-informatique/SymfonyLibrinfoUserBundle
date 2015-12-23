<?php

namespace Librinfo\UserBundle\Entity\Traits;

use Symfony\Component\Security\Core\User\UserInterface;

trait Ownable
{
    /**
     * @var UserInterface
     */
    private $owner = null;

    /**
     * @return UserInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     * @return self
     */
    public function setOwner(UserInterface $owner = NULL)
    {
        $this->owner = $owner;
        return $this;
    }
}
