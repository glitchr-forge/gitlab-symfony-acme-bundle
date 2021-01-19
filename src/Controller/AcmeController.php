<?php

// src/Acme/AcmeBundle/Controller/AcmeController.php
namespace Acme\AcmeBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcmeController extends AbstractController
{
    /**
     * Controller example
     *
     * @Route("/acme", name="app_acme")
     */
    public function Main()
    {
        return new Response('<html><body>Beep beep !</body></html>');
    }
}
