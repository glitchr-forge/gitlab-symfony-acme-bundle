<?php
namespace Acme\AcmeBundle\Service;
use Acme\AcmeBundle\Controller\AcmeController;

class AcmeService
{
    public function __construct()
    {
        // Just a test variable
        AcmeController::$foundAcmeService = true;

        /* Add some logic here */
    }
}