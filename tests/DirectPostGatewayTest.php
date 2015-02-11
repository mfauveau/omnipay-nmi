<?php
namespace Omnipay\NMI;

use Omnipay\Tests\GatewayTestCase;

class DirectPostGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new DirectPostGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSaleSuccess()
    {

    }

    public function testSaleFailure()
    {

    }

    public function testAuthSuccess()
    {

    }

    public function testAuthFailure()
    {

    }

    public function testCaptureSuccess()
    {

    }

    public function testCaptureFailure()
    {

    }

    public function testVoidSuccess()
    {

    }

    public function testVoidFailure()
    {

    }

    public function testRefundSuccess()
    {

    }

    public function testRefundFailure()
    {

    }

    public function testCreditSuccess()
    {

    }

    public function testCreditFailure()
    {

    }

    public function testValidateSuccess()
    {

    }

    public function testValidateFailure()
    {

    }

}
