<?php

namespace MyCompany\PublishBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PublishBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }	
}
