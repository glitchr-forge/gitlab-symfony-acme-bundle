<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\AcmeBundle\Twig;
use Acme\AcmeBundle\Controller\AcmeController;

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\AbstractExtension;
/**
 * @author Marco Meyer <marco.meyerconde@gmail.com>
 *
 * @final
 * @experimental
 */

use Symfony\Component\DependencyInjection\Container;

class AcmeTwigExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct() {

        // Just a test variable
        AcmeController::$foundAcmeTwigExtension = true;

        /* Add some logic here */
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('acme_gag', [$this, 'gagFunction'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    public function getGlobals(): array {

        return array(
            'acme' => [
                'gag1' => "Anvil",
                'gag2' => "TNT"
            ]
        );
    }

    public function gagFunction(Environment $env, string $input, string $gag, array $attributes = []): string
    {
        return "Acme calls gagFunction($input, $gag)";
    }
}
