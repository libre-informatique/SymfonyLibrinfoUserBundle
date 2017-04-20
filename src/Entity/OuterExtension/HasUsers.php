<?php

namespace Librinfo\UserBundle\Entity\OuterExtension;

use Symfony\Component\Security\Core\User\UserInterface;

trait HasUsers
{
    /**
     * @var Collection
     */
    private $users;
    
    /**
     * @param UserInterface $user
     * @return Circle
     */
    public function addUser(UserInterface $user)
    {
        $this->users->add($user);
        
        return $this;
    }

    /**
     * @param UserInterface $user
     * @return Circle
     */
    public function removeUser(UserInterface $user)
    {
        $this->users->removeElement($user);
        
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    public function initUsers()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
