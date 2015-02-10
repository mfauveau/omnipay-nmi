<?php
namespace Omnipay\NMI\Message;

/**
* NMI Direct Post Credit Request
*/
class DirectPostCreditRequest extends AbstrastRequest
{
    protected $type = 'credit';

    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData();
        $data['ccnumber'] = $this->getCard()->getNumber();
        $data['ccexp'] = $this->getCard()->getExpiryDate('my');
        $data['amount'] = $this->getAmount();

        return array_merge(
            $data,
            $this->getOrderData(),
            $this->getBillingData()
        );
    }
}
