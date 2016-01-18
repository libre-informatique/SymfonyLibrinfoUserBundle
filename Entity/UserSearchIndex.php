<?php

namespace Librinfo\UserBundle\Entity;

use Librinfo\DoctrineBundle\Entity\SearchIndexEntity;

class UserSearchIndex extends SearchIndexEntity
{
    // TODO: this should go in the user.orm.yml mapping file :
    //       find a way to override Doctrine ORM YamlDriver and ClassMetadata classes
    public static $fields = ['username', 'firstname', 'name', 'email'];
}
