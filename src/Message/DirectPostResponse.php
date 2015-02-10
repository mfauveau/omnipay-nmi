<?php
namespace Omnipay\AuthorizeNet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
* NMI Direct Post Response
*/
class DirectPostResponse extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {

    }

    public function getCode()
    {

    }

    public function getResponseCode()
    {

    }

    public function getMessage()
    {

    }

    public function getAuthorizationCode()
    {

    }

    public function getAVSResponse()
    {

    }

    public function getCVVResponse()
    {

    }

    public function getOrderId()
    {

    }

    public function getTransactionReference()
    {

    }
}
