<?php

namespace Acme\AcmeBundle\Subscriber;

use \Symfony\Component\HttpKernel\Event\ControllerEvent;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpKernel\KernelEvents;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AcmeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [ KernelEvents::CONTROLLER => ['onKernelController'] ];
    }

    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();
	dump("[".__CLASS__."] Hello World!");
    }
}

