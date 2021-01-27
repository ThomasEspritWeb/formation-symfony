<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('taille', [$this, 'getLength']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('addition', [$this, 'calculAdd']),
        ];
    }

    public function getLength(array $tableau){
        return "Actuellement ". count($tableau). " articles";
    }

    public function calculAdd(int $chiffre1, int $chiffre2){
        return $chiffre1 + $chiffre2;
    }
}
