<?php

// src/Acme/AcmeBundle/Controller/AcmeController.php
namespace Acme\AcmeBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AcmeController
{
    /**
     * Controller example
     *
     * @Route("/acme", name="app_acme")
     */
    public function BeepBeep()
    {
        return new Response('<html><body>Beep beep !</body></html>');
    }
}
