<?php
declare (strict_types = 1);
namespace App\MesClasses;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $gateawayService,
        protected EmailService $emailService
    ){
    }

    public function process (array $customer, float $amount):bool
    {
       /*
        $salesTaxService = new SalesTaxService();
        $gateawayService = new PaymentGatewayService();
        $emailService = new EmailService();
       */

        // 1.Calculer la taxe
        $tax = $this->salesTaxService->calculate($amount);

        // 2. Voir si la facture est payée ou non
        if (!$this->gateawayService->charge($customer, $amount, $tax)) {
            return false;
        }

        // 3. Envoyer la facture par email
        $this->emailService->send($customer,'receipt');

        return true;
    }
}