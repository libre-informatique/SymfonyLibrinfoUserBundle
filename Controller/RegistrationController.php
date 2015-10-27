<?php

namespace Librinfo\UserBundle\Controller;

use Sonata\UserBundle\Controller\RegistrationFOSUser1Controller as SonataRegistrationController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends SonataRegistrationController {
    public function registerAction() {
        throw new NotFoundHttpException();
    }
    public function checkEmailAction() {
        throw new NotFoundHttpException();
    }
    public function confirmAction($token) {
        throw new NotFoundHttpException();
    }
    public function confirmedAction() {
        throw new NotFoundHttpException();
    }
}
