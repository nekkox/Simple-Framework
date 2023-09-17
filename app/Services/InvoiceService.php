<?php
//MOCKING allows us to fake dependencies of the method or class that is being tested and swap the real class
//dependencies with fake ones
// mocking DB classes, Models, Email & sms, API calls
namespace App\Services;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService       $salesTaxService,
        protected EmailService          $emailService,
        protected PaymentGatewayInterface $paymentGatewayService
    )
    {
    }

    public function process(array $customer, float $amount): bool
    {
        //dependieces
        // $salesTaxService = new SalesTaxService();
        //  $gatewayService = new StripePayment();
        // $emailService = new EmailService();

        // 1. Calculate sales tax
        //  $tax = $salesTaxService->calculate($amount, $customer);
        $tax = $this->salesTaxService->calculate($amount, $customer);
        // 2. Process invoice
        if (!$this->paymentGatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        // 3. Send receipt email

        $this->emailService->send($customer, 'receipt');

        echo "Invoice has been processed";

        return true;
    }

}