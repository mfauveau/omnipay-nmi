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
        return trim($this->data['response']);
    }

    public function getResponseCode()
    {
        return trim($this->data['response_code']);
    }

    public function getMessage()
    {
        return trim($this->data['responsetext']);
    }

    public function getAuthorizationCode()
    {
        return trim($this->data['authcode']);
    }

    public function getAVSResponse()
    {
        return trim($this->data['avsresponse']);
    }

    public function getCVVResponse()
    {
        return trim($this->data['cvvresponse']);
    }

    public function getOrderId()
    {
        return trim($this->data['orderid']);
    }

    public function getTransactionReference()
    {
        return trim($this->data['transactionid']);
    }

    public function getCardReference()
    {
        if (isset($this->data['customer_vault_id'])) {
            return trim($this->data['customer_vault_id']);
        }

        return null;
    }
}
