<?php
namespace Omnipay\NMI\Message;

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
        parse_str($data, $this->data);
    }

    public function isSuccessful()
    {
        return '1' === $this->getCode();
    }

    public function getCode()
    {
        return $this->data['response'];
    }

    public function getResponseCode()
    {
        return $this->data['response_code'];
    }

    public function getMessage()
    {
        return $this->data['responsetext'];
    }

    public function getAuthorizationCode()
    {
        return $this->data['authcode'];
    }

    public function getAVSResponse()
    {
        return $this->data['avsresponse'];
    }

    public function getCVVResponse()
    {
        return $this->data['cvvresponse'];
    }

    public function getOrderId()
    {
        return $this->data['orderid'];
    }

    public function getTransactionReference()
    {
        return $this->data['transactionid'];
    }
}
