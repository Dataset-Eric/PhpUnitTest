<?php

namespace App\MesClasses;

class PaymentGatewayService
{
    /**
     * Détermine si la facture est payée ou non (aléatoire)
     * @param array $customer
     * @param float $amount
     * @param float $tax
     * @return bool
     */
    public function charge(array $customer, float $amount, float $tax):bool
    {
       sleep(1);
       return (bool) mt_rand(0,1);
    }
}