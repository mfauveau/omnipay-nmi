<?php
namespace Omnipay\NMI;

use Omnipay\Tests\GatewayTestCase;

class DirectPostGatewayTest extends GatewayTestCase
{
    protected $successOptions;
    protected $failureOptions;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new DirectPostGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->successOptions = array(
            'amount' => '10.00',
            'card'   => $this->getValidCard()
        );

        $this->failureOptions = array(
            'amount' => '0.00',
            'card'   => $this->getValidCard()
        );
    }

    public function testAuthorizeSuccess()
    {
        $this->setMockHttpResponse('DirectPostAuthSuccess.txt');

        $response = $this->gateway->authorize($this->successOptions)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2577708057', $response->getTransactionReference());
        $this->assertSame('SUCCESS', $response->getMessage());
    }

    public function testAuthorizeFailure()
    {
        $this->setMockHttpResponse('DirectPostAuthFailure.txt');

        $response = $this->gateway->authorize($this->failureOptions)->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('2577711599', $response->getTransactionReference());
        $this->assertSame('DECLINE', $response->getMessage());
    }

    public function testSaleSuccess()
    {

    }

    public function testSaleFailure()
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
