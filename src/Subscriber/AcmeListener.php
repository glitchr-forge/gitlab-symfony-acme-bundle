<?php

namespace Acme\AcmeBundle\Subscriber;
use Acme\AcmeBundle\Controller\AcmeController;

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
