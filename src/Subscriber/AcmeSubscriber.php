<?php

namespace Acme\AcmeBundle\Subscriber;

use \Symfony\Component\HttpKernel\Event\GetResponseEvent;
use \Symfony\Component\HttpFoundation\Response;

class AcmeSubscriber
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
	dump("[".__CLASS__."] Hello World!");
    }
}

