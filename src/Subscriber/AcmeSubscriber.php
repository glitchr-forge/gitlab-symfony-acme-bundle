<?php

namespace Acme\Bundle\Subscriber;
use Acme\Bundle\Controller\AcmeController;

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
        // Just a test variable
        AcmeController::$foundAcmeSubscriber = true;

        /* Add some logic here */
    }
}
