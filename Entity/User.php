<?php

namespace Librinfo\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;

class User extends BaseUser
{

    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tells if the the given user is this user.
     *
     * Useful when not hydrating all fields.
     *
     * @param null|UserInterface $user
     *
     * @return boolean
     */
    public function isUser(UserInterface $user = null)
    {
        // TODO: Implement isUser() method.
    }
}