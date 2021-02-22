<?php

namespace Acme\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

         /* Put some additional logic here */
    }
}
