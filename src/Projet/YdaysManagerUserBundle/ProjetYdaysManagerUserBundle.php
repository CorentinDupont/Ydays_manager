<?php

namespace Projet\YdaysManagerUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProjetYdaysManagerUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
