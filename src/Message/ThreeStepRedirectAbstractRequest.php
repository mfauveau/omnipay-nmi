<?php

namespace Omnipay\NMI\Message;

use Omnipay\Common\CreditCard;
use RuntimeException;
use SimpleXMLElement;

/**
 * NMI Three Step Redirect Abstract Request
 */
abstract class ThreeStepRedirectAbstractRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://secure.nmi.com/api/v2/three-step';

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('api_key');
    }

    /**
     * @param string
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiKey($value)
    {
        return $this->setParameter('api_key', $value);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->getParameter('redirect_url');
    }

    /**
     * @param string
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setRedirectUrl($value)
    {
        return $this->setParameter('redirect_url', $value);
    }

    /**
     * @return string
     */
    public function getTokenId()
    {
        return $this->getParameter('token_id');
    }

    /**
     * @param string
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTokenId($value)
    {
        return $this->setParameter('token_id', $value);
    }

    /**
     * Sets the card.
     *
     * @param CreditCard $value
     * @return AbstractRequest Provides a fluent interface
     */
    public function setCard($value)
    {
        if (!$value instanceof CreditCard) {
            $value = new CreditCard($value);
        }

        return $this->setParameter('card', $value);
    }

    /**
     * @return string
     */
    public function getSecCode()
    {
        return $this->getParameter('sec_code');
    }

    /**
     * @param string
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSecCode($value)
    {
        return $this->setParameter('sec_code', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField1()
    {
        return $this->getParameter('merchant_defined_field_1');
    }

    /**
     * Sets the first merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField1($value)
    {
        return $this->setParameter('merchant_defined_field_1', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField2()
    {
        return $this->getParameter('merchant_defined_field_2');
    }

    /**
     * Sets the second merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField2($value)
    {
        return $this->setParameter('merchant_defined_field_2', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField3()
    {
        return $this->getParameter('merchant_defined_field_3');
    }

    /**
     * Sets the third merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField3($value)
    {
        return $this->setParameter('merchant_defined_field_3', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField4()
    {
        return $this->getParameter('merchant_defined_field_4');
    }

    /**
     * Sets the fourth merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField4($value)
    {
        return $this->setParameter('merchant_defined_field_4', $value);
    }

    /**
     * @return array
     */
    protected function getOrderData()
    {
        $data = array();

        $data['order-id'] = $this->getOrderId();
        $data['order-description'] = $this->getOrderDescription();
        $data['tax-amount'] = $this->getTax();
        $data['shipping-amount'] = $this->getShipping();
        $data['po-number'] = $this->getPONumber();
        $data['ip-address'] = $this->getClientIp();

        if ($this->getCurrency()) {
            $data['currency'] = $this->getCurrency();
        }

        if ($this->getSecCode()) {
            $data['sec-code'] = $this->getSecCode();
        }

        return $data;
    }

    /**
     * @return array
     */
    protected function getBillingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            $data['billing'] = array(
                'first-name' => $card->getBillingFirstName(),
                'last-name'  => $card->getBillingLastName(),
                'address1'   => $card->getBillingAddress1(),
                'city'       => $card->getBillingCity(),
                'state'      => $card->getBillingState(),
                'postal'     => $card->getBillingPostcode(),
                'country'    => $card->getBillingCountry(),
                'phone'      => $card->getBillingPhone(),
                'email'      => $card->getEmail(),
                'company'    => $card->getBillingCompany(),
                'address2'   => $card->getBillingAddress2(),
                'fax'        => $card->getBillingFax(),
            );
        }

        return $data;
    }

    /**
     * @return array
     */
    protected function getShippingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            $data['shipping'] = array(
                'first-name' => $card->getShippingFirstName(),
                'last-name'  => $card->getShippingLastName(),
                'address1'   => $card->getShippingAddress1(),
                'city'       => $card->getShippingCity(),
                'state'      => $card->getShippingState(),
                'postal'     => $card->getShippingPostcode(),
                'country'    => $card->getShippingCountry(),
                'email'      => $card->getEmail(),
                'company'    => $card->getShippingCompany(),
                'address2'   => $card->getShippingAddress2(),
            );
        }

        return $data;
    }

    /**
     * @param array
     * @return \Omnipay\NMI\Message\ThreeStepRedirectResponse
     */
    public function sendData($data)
    {
        $document = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><'.$this->type.'/>');
        $this->arrayToXml($document, $data);

        $httpRequest = $this->httpClient->post(
            $this->getEndpoint(),
            array(
                'Content-Type' => 'text/xml',
                'User-Agent'   => 'Omnipay',
            ),
            $document->asXML()
        );

        $httpResponse = $httpRequest->send();

        return $this->response = new ThreeStepRedirectResponse($this, $httpResponse->xml());
    }

    /**
     * @param \SimpleXMLElement
     * @param array
     * @return void
     */
    private function arrayToXml(SimpleXMLElement $parent, array $data)
    {
        foreach ($data as $name => $value) {
            if (is_array($value)) {
                $child = $parent->addChild($name);
                $this->arrayToXml($child, $value);
            }
            else {
                $parent->addChild($name, htmlspecialchars($value));
            }
        }
    }
}
