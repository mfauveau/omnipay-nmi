<?php
namespace Omnipay\NMI\Message;

/**
 * NMI Direct Post Authorize Request
 */
class DirectPostAuthRequest extends AbstractRequest
{
    protected $type = 'auth';

    public function getData()
    {
        $this->validate('amount');

        $data = $this->getBaseData();
        $data['amount'] = $this->getAmount();

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
