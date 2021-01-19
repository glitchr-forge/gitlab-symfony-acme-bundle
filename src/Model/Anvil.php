<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace xKzl\AcmeBundle\Model;

class Anvil
{
    private $options = [];

    public function __construct(string $weight)
    {
        $this->options["weight"] = $weight;
    }

    public function createView(): array
    {
        return [
            'options' => $this->options,
        ];
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
