<?php

namespace Librinfo\UserBundle\Entity;

use FOS\UserBundle\Model\Group as Grp;

class Group extends Grp
{
    private $users;

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

}