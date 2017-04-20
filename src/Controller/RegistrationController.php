<?php

namespace Librinfo\UserBundle\Controller;

use Sonata\UserBundle\Controller\RegistrationFOSUser1Controller as SonataRegistrationController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends SonataRegistrationController
{
    public function registerAction()
    {
        if ($this->container->get('request')->getPathInfo() == "/_fragment")
            return new Response('', 200);
        else
            throw new NotFoundHttpException();
    }

    public function checkEmailAction()
    {
        throw new NotFoundHttpException();
    }

    public function confirmAction($token)
    {
        throw new NotFoundHttpException();
    }

    public function confirmedAction()
    {
        throw new NotFoundHttpException();
    }
}
