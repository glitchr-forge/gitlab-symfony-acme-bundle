<?php

namespace Acme\AcmeBundle\Listener;

use \Symfony\Component\HttpKernel\Event\GetResponseEvent;
use \Symfony\Component\HttpFoundation\Response;

class AcmeListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
	dump("[".__CLASS__."] Hello World!");
    }
}

