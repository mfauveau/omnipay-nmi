<?php

namespace Omnipay\NMI\Message;

/**
* NMI Create Credit Card Request
*/
class CreateCardRequest extends AbstractRequest
{
    protected $customer_vault = 'add_customer';

    public function getData()
    {
        $this->validate('card');
        $this->getCard()->validate();

        $data = $this->getBaseData();

        $data['ccnumber'] = $this->getCard()->getNumber();
        $data['ccexp'] = $this->getCard()->getExpiryDate('my');
        $data['payment'] = 'creditcard';

        return $data;
    }
}
