<?php

namespace Transfer\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TransferMainBundle extends Bundle
{
    public function getParent()
    {
        return 'ApplicationSonataUserBundle';
    }
}
