<?php

namespace Acme\AcmeBundle\Subscriber;

use \Symfony\Component\HttpKernel\Event\RequestEvent;
use \Symfony\Component\HttpFoundation\Response;

class AcmeListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        dump("[".__CLASS__."] Hello World!");
    }
}
