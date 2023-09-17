<?php

namespace Services;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\StripePayment;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{

    public function test_it_processes_invoice()
    {
        //We want to test that Invoice is processed successfully
        // and we don't care if Email was sent or the tax was calculated correctly

        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayMock = $this->createMock(StripePayment::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        //stubing charge method on the fake GatewayService class adn sspecyfying that this
        //method should return true
        $paymentGatewayMock->method('charge')->willReturn(true);

        //given invoice service
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $emailServiceMock,
            $paymentGatewayMock);

        $customer = ['name' => 'xxxx'];
        $amount = 200;

        //when the process method is called
        $result = $invoiceService->process($customer, $amount);

        //then
        //assert the invoice is processed successfully
        $this->assertTrue($result);


    }

// we need to fake the dependencies and replace them with test doubles
// we can create test doubles by creating a createmock method

    public function test_it_sends_receipt_email_when_invoice_is_processed(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayMock = $this->createMock(StripePayment::class);
        $emailServiceMock = $this->createMock(EmailService::class);


        $paymentGatewayMock->method('charge')->willReturn(true);

        //we are expecting send method to be called one time and the arguments passed to
        //the send method should match the arguments that we specified within
        //the process method

            $emailServiceMock
            ->method('send')->willReturn(false);
            //->with(['name' => 'xxx'], 'receipt');

            $salesTaxServiceMock
                ->method('calculate')
                ->willReturn(2.5);



        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $emailServiceMock,
            $paymentGatewayMock);


        $customer = ['name' => 'xxx'];
        $amount = 2.5;


        $result = $invoiceService->process($customer, $amount);

         $emailServiceMock->method('send')->willReturn(false);
         $e = $emailServiceMock->send($customer,$amount);
        $this->assertTrue($result);
        $this->assertEquals(false, $e);
      $this->assertEquals($amount, $salesTaxServiceMock->calculate(20,['hh']));


        //We can set up expectations on the mock objects. So we can say that EmailService Class
        //is expected to call the send method with a given arguments
    }

    public function test_funny(){
        $emailMock = $this->getMockBuilder(EmailService::class)->getMock();
       // $emailMock->send('toXXX@example.com','temp');
        $emailMock->expects($this->once())->method('send')->willReturn(true);
        var_dump($emailMock->send(['toXXX@example.com'],'temp'));
    }


}