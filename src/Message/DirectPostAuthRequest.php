<?php
namespace Omnipay\NMI\Message;

/**
 * NMI Direct Post Authorize Request
 */
class DirectPostAuthRequest extends AbstrastRequest
{
    protected $type = 'auth';

    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData();
        $data['ccnumber'] = $this->getCard()->getNumber();
        $data['ccexp'] = $this->getCard()->getExpiryDate('my');
        $data['amount'] = $this->getAmount();
        $data['cvv'] = $this->getCard()->getCvv();

        return array_merge(
            $data,
            $this->getOrderData(),
            $this->getBillingData(),
            $this->getShippingData()
        );
    }
}
