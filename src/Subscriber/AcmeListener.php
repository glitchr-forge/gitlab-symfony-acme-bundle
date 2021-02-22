<?php

namespace Acme\Bundle\Subscriber;
use Acme\Bundle\Controller\AcmeController;

use \Symfony\Component\HttpKernel\Event\RequestEvent;
use \Symfony\Component\HttpFoundation\Response;

class AcmeListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        // Just a test variable
        AcmeController::$foundAcmeListener = true;

        /* Add some logic here */
    }
}
