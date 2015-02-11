<?php

namespace Omnipay\NMI\Message;

/**
* NMI Delete Credit Card Request
*/
class DeleteCardRequest extends AbstractRequest
{
    protected $customer_vault = 'delete_customer';

    public function getData()
    {
        $this->validate('cardReference');

        $data = $this->getBaseData();

        $data['customer_vault_id'] = $this->getCardReference();

        return $data;
    }
}
