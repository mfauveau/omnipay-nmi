<?php
namespace Omnipay\NMI\Message;

/**
 * NMI Direct Post Authorize Request
 */
class DirectPostAuthRequest extends AbstractRequest
{
    protected $type = 'auth';

    /**
     * @return string
     */
    public function getMerchantDefinedField_1()
    {
        return $this->getParameter('merchant_defined_field_1');
    }

    /**
     * Sets the first merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField_1($value)
    {
        return $this->setParameter('merchant_defined_field_1', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField_2()
    {
        return $this->getParameter('merchant_defined_field_2');
    }

    /**
     * Sets the second merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField_2($value)
    {
        return $this->setParameter('merchant_defined_field_2', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField_3()
    {
        return $this->getParameter('merchant_defined_field_3');
    }

    /**
     * Sets the third merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField_3($value)
    {
        return $this->setParameter('merchant_defined_field_3', $value);
    }

    /**
     * @return string
     */
    public function getMerchantDefinedField_4()
    {
        return $this->getParameter('merchant_defined_field_4');
    }

    /**
     * Sets the fourth merchant defined field.
     *
     * @param string
     * @return AbstractRequest Provides a fluent interface
     */
    public function setMerchantDefinedField_4($value)
    {
        return $this->setParameter('merchant_defined_field_4', $value);
    }

    public function getData()
    {
        $this->validate('amount');

        $data = $this->getBaseData();
        $data['amount'] = $this->getAmount();

        if ($this->getMerchantDefinedField_1()) {
            $data['merchant_defined_field_1'] = $this->getMerchantDefinedField_1();
        }

        if ($this->getMerchantDefinedField_2()) {
            $data['merchant_defined_field_2'] = $this->getMerchantDefinedField_2();
        }

        if ($this->getMerchantDefinedField_3()) {
            $data['merchant_defined_field_3'] = $this->getMerchantDefinedField_3();
        }

        if ($this->getMerchantDefinedField_4()) {
            $data['merchant_defined_field_4'] = $this->getMerchantDefinedField_4();
        }

        if ($this->getCardReference()) {
            $data['customer_vault_id'] = $this->getCardReference();

            return $data;
        } else {
            $this->getCard()->validate();

            $data['ccnumber'] = $this->getCard()->getNumber();
            $data['ccexp'] = $this->getCard()->getExpiryDate('my');
            $data['cvv'] = $this->getCard()->getCvv();

            return array_merge(
                $data,
                $this->getOrderData(),
                $this->getBillingData(),
                $this->getShippingData()
            );
        }
    }
}
