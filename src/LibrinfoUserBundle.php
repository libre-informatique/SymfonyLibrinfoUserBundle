<?php

namespace Librinfo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LibrinfoUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }

}
