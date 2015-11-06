<?php

namespace Librinfo\UserBundle\Tests\Controller;

use FOS\UserBundle\Entity\User;
use Librinfo\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $datafixtures;

    public function __construct(){
        parent::__construct();
        $client = static::createClient();

        $this->datafixtures = $client->getContainer()->getParameter('librinfo.userbundle.datafixtures');
    }

    /**
     * testsUser
     *
     */
    public function testsUser()
    {
        $client = static::createClient();

        /** @var User $user */
        $user = $client->getContainer()->get('librinfo_core.services.authenticate')->authencicateUser($this->datafixtures['user']['username']);

        $this->assertTrue($user->isUser() === true);

        $time = new \DateTime();
        $user->setLastLogin($time);

        $this->assertEquals($time, $user->getLastLogin());
    }
}
