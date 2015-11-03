<?php

namespace Librinfo\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FOSUserGetRolesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fos:user:getroles')
            ->setDescription('Returns specified user\'s roles')
            ->addArgument(
                'username',
                InputArgument::REQUIRED,
                'The target username'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');

        if ($username)
        {
            $user = $this->getContainer()
                ->get('fos_user.user_manager')
                ->findUserBy(['username' => $username]);

            $output->writeln(print_r($user->getRoles(), true));
        }

    }
}