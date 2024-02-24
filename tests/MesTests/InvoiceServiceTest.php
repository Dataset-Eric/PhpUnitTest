<?php

namespace App\Tests\MesTests;

use App\MesClasses\EmailService;
use App\MesClasses\InvoiceService;
use App\MesClasses\PaymentGatewayService;
use App\MesClasses\SalesTaxService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testProcess(): void
    {
        $customer = ['name'=>'David'];
        $amount = 100.00;

        //Création des stubs
        $salesTaxServiceStub = $this->createStub(SalesTaxService::class);
        $gateawayServiceStub = $this->createStub(PaymentGatewayService::class);

        //Simulation des retours des méthodes calculate et charge
        $salesTaxServiceStub->method('calculate')->willReturn(21.0);
        $gateawayServiceStub->method('charge')->willReturn(true);

        //Création des mocks
        $emailServiceMock = $this->createMock(EmailService::class);

        //Simulation des paramètres de la méthode send
        $emailServiceMock->expects($this->once())
                        ->method('send')
                        ->with($customer, 'receipt');

        $invoiceService = new InvoiceService($salesTaxServiceStub, $gateawayServiceStub, $emailServiceMock);

        $result = $invoiceService->process($customer, $amount);
        $this->assertTrue($result);
    }
}
