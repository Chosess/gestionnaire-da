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

        foreach ($string as $caractere) {
            if (ctype_lower($caractere)) {
                $caractere = strtoupper($caractere);
            } else if(ctype_upper($caractere)){
                $caractere = strtolower($caractere);
            } else if($caractere != 0 && ctype_digit($caractere)){
                $caractere = (10 - $caractere) . '';
            } 
            $valeur[] = $caractere;
        }

        $string = join($valeur);


        return $string;
    }

    public function decode(string $string)
    {
        $string = str_split($string);

        $valeur = [];

        foreach ($string as $caractere) {
            if (ctype_lower($caractere)) {
                $caractere = strtoupper($caractere);
            } else if(ctype_upper($caractere)){
                $caractere = strtolower($caractere);
            } else if($caractere != 0 && ctype_digit($caractere)){
                $caractere = (10 - $caractere) . '';
            }
            $valeur[] = $caractere;
        }

        $string = join($valeur);

        $string = base64_decode($string);

        return $string;
    }
}
