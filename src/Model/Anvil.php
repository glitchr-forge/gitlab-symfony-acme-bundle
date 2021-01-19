<?php

namespace Acme\AcmeBundle\Model;

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
