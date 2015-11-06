<?php

namespace Librinfo\UserBundle\Tests\Controller;

use FOS\UserBundle\Entity\User;
use Librinfo\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    private $datafixtures;

    public function __construct(){
        parent::__construct();
        $client = static::createClient();

        $this->datafixtures = $client->getContainer()->getParameter('librinfo.userbundle.datafixtures');
    }

    /**
     * testsGroup
     *
     */
    public function testsAdd()
    {
        $client = static::createClient();

        /** @var User $user */
        $user = $client->getContainer()->get('librinfo_core.services.authenticate')->authencicateUser($this->datafixtures['user']['username']);
        $this->assertNotEmpty($user);

        $group = new Group();
        $group->addUser($user);

        $this->assertContains($user, $group->getUsers());

        $group->removeUser($user);
        $this->assertNotContains($user, $group->getUsers());
    }
}
