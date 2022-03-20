<?php

namespace Acme\Bundle\DependencyInjection;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class CacheWarmer implements CacheWarmerInterface
{
    protected $shellVerbosity = 0; 
    public function __construct(/* Inject services here */)
    {
        $this->shellVerbosity = getenv("SHELL_VERBOSITY");
    }

    public function isOptional():bool { return false; }
    public function warmUp($cacheDir): array
    {
        if($this->shellVerbosity > 0) echo " // Warming up cache... Acme Bundle".PHP_EOL.PHP_EOL;

        /*
         * Call here time consuming commands..
         */

        return [/*get_class(..), resourcefiles*/];
    }
}