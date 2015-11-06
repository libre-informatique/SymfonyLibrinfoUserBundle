<?php

namespace Librinfo\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\Group as Grp;

class Group extends Grp
{
    private $users;

    public function __construct($name = null, $roles = array())
    {
        parent::__construct($name, $roles);
        $this->users = new ArrayCollection();
    }

    /**
     * addUser
     *
     * @param User $user
     *
     * @return $this
     */
    public function addUser($user)
    {
        if (!$this->getUsers()->contains($user))
        {
            $this->getUsers()->add($user);
            $user->addGroup($this);
        }

        return $this;
    }

    /**
     * removeUser
     *
     * @param User $user
     *
     * @return $this
     */
    public function removeUser($user)
    {
        if ($this->getUsers()->contains($user))
        {
            $this->getUsers()->removeElement($user);
            $user->removeGroup($this);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     *
     * @return $this
     */
    public function setUsers($users)
    {

        $this->users = $users;

        return $this;
    }

    /**
     * __toString
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }
}