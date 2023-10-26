<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class ChiffrementService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function encode(string $string)
    {
        return $string;
    }

    public function decode(string $string)
    {
        return $string;
    }
}
