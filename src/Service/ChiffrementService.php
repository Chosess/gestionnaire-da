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
        $string = base64_encode($string);

        $string = str_split($string);
        $valeur = [];

        foreach ($string as $caractère) {
            if (ctype_lower($caractère)) {
                $caractère = strtoupper($caractère);
            } else if(ctype_upper($caractère)){
                $caractère = strtolower($caractère);
            } else if($caractère != 0 && ctype_digit($caractère)){
                $caractère = (10 - $caractère) . '';
            } 
            $valeur[] = $caractère;
        }

        $string = join($valeur);


        return $string;
    }

    public function decode(string $string)
    {
        $string = str_split($string);

        $valeur = [];

        foreach ($string as $caractère) {
            if (ctype_lower($caractère)) {
                $caractère = strtoupper($caractère);
            } else if(ctype_upper($caractère)){
                $caractère = strtolower($caractère);
            } else if($caractère != 0 && ctype_digit($caractère)){
                $caractère = (10 - $caractère) . '';
            }
            $valeur[] = $caractère;
        }

        $string = join($valeur);

        $string = base64_decode($string);

        return $string;
    }
}
