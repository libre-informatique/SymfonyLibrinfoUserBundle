<?php

namespace Librinfo\UserBundle\Tests\Controller;

use FOS\UserBundle\Entity\User;
use Librinfo\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $datafixtures;
    private $client;

    public function init(){
        $this->client = static::createClient();
        $this->datafixtures = $this->client->getContainer()->getParameter('librinfo.userbundle.datafixtures');
    }

    /**
     * testsUser
     *
     */
    public function testsUser()
    {
        $this->init();
        /** @var User $user */
        $user = $this->client->getContainer()->get('librinfo_core.services.authenticate')->authencicateUser($this->datafixtures['user']['username']);

        $this->assertTrue($user->isUser() === true);

        $time = new \DateTime();
        $user->setLastLogin($time);

        $this->assertEquals($time, $user->getLastLogin());
    }
}
