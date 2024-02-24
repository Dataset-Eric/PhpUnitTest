<?php

namespace App\MesClasses;

class SalesTaxService
{
    public function calculate(float $amount):float
    {
        return $amount * 0.21;
    }
}