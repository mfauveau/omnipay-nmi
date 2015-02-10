<?php
namespace Omnipay\NMI\Message;

/**
* NMI
*/
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://secure.nmi.com/api/transact.php';

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderid');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderid', $value);
    }

    public function getOrderDescription()
    {
        return $this->getParameter('orderdescription');
    }

    public function setOrderDescription($value)
    {
        return $this->setParameter('orderdescription', $value);
    }

    public function getTax()
    {
        return $this->getParameter('tax');
    }

    public function setTax($value)
    {
        return $this->setParameter('tax', $value);
    }

    public function getShipping()
    {
        return $this->getParameter('shipping');
    }

    public function setShipping($value)
    {
        return $this->setParameter('shipping', $value);
    }

    public function getPONumber()
    {
        return $this->getParameter('ponumber');
    }

    public function setPONumber($value)
    {
        return $this->setParameter('ponumber', $value);
    }

    protected function getBaseData()
    {
        $data = array();

        $data['type'] = $this->type;
        $data['username'] = $this->getUsername();
        $data['password'] = $this->getPassword();

        return $data;
    }

    protected function getOrderData()
    {
        $data = array();

        $data['orderid'] = $this->getOrderId();
        $data['orderdescription'] = $this->getOrderDescription();
        $data['tax'] = $this->getTax();
        $data['shipping'] = $this->getShipping();
        $data['ponumber'] = $this->getPONumber();
        $data['ipaddress'] = $this->getClientIp();

        return $data;
    }

    protected function getBillingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            $data['firstname'] = $card->getBillingFirstName();
            $data['lastname'] = $card->getBillingLastName();
            $data['company'] = $card->getBillingCompany();
            $data['address1'] = $card->getBillingAddress1();
            $data['address2'] = $card->getBillingAddress2();
            $data['city'] = $card->getBillingCity();
            $data['state'] = $card->getBillingState();
            $data['zip'] = $card->getBillingPostcode();
            $data['country'] = $card->getBillingCountry();
            $data['phone'] = $card->getBillingPhone();
            $data['fax'] = $card->getBillingFax();
            $data['email'] = $card->getEmail();
            // $data['website'] = $card->getWebsite();
        }

        return $data;
    }

    protected function getShippingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            $data['shipping_firstname'] = $card->getShippingFirstName();
            $data['shipping_lastname'] = $card->getShippingLastName();
            $data['shipping_company'] = $card->getShippingCompany();
            $data['shipping_address1'] = $card->getShippingAddress1();
            $data['shipping_address2'] = $card->getShippingAddress2();
            $data['shipping_city'] = $card->getShippingCity();
            $data['shipping_state'] = $card->getShippingState();
            $data['shipping_zip'] = $card->getShippingPostcode();
            $data['shipping_country'] = $card->getShippingCountry();
            $data['shipping_email'] = $card->getEmail();
        }

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();

        return $this->response = new DirectPostResponse($this, $httpResponse->getBody());
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
