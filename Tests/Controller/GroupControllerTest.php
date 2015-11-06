<?php

namespace Librinfo\UserBundle\Tests\Controller;

use FOS\UserBundle\Entity\User;
use Librinfo\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    private $datafixtures;
    private $client;

    public function init(){
        $this->client = static::createClient();
        $this->datafixtures = $this->client->getContainer()->getParameter('librinfo.userbundle.datafixtures');
    }

    /**
     * testsGroup
     *
     */
    public function testsAdd()
    {
        $this->init();
        /** @var User $user */
        $user = $this->client->getContainer()->get('librinfo_core.services.authenticate')->authencicateUser($this->datafixtures['user']['username']);
        $this->assertNotEmpty($user);

        $group = new Group();
        $group->addUser($user);

        $this->assertContains($user, $group->getUsers());

        $group->removeUser($user);
        $this->assertNotContains($user, $group->getUsers());
    }
}
