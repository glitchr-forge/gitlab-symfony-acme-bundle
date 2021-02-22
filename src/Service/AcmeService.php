<?php
namespace Acme\Bundle\Service;
use Acme\Bundle\Controller\AcmeController;

class AcmeService
{
    public function __construct()
    {
        // Just a test variable
        AcmeController::$foundAcmeService = true;

        /* Add some logic here */
    }
}