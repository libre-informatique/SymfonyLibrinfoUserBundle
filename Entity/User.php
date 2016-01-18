<?php

namespace Librinfo\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Librinfo\DoctrineBundle\Entity\Traits\Stringable;
use Librinfo\DoctrineBundle\Entity\Traits\Searchable;

class User extends BaseUser
{
    use Stringable,
        Searchable;

    protected $id;
    protected $name;
    protected $firstname;

    public function __construct()
    {
        parent::__construct();
    }

    public function setLastLogin(\DateTime $time = null)
    {
        $this->lastLogin = $time;

        return $this;
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
        return true;
    }

    /**
     * __toString
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    public function setExpiresAt(\DateTime $date = null)
    {
        $this->expiresAt = $date;
    }

    public function setCredentialsExpireAt(\DateTime $date = null)
    {
        $this->credentialsExpireAt = $date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    /**
     * @return mixed
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->firstname;
    }
    /**
     * @return mixed
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
