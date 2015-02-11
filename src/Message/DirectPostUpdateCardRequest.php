<?php

namespace Omnipay\NMI\Message;

/**
* NMI Update Credit Card Request
*/
class UpdateCardRequest extends CreateCardRequest
{
    protected $customer_vault = 'update_customer';
}
