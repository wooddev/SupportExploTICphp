<?php

namespace Explotic\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExploticAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
