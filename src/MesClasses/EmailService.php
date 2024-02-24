<?php

namespace App\MesClasses;

class EmailService
{
    public function send(array $customer, string $type):bool
    {
       sleep(1);
       return true;
    }
}