<?php
namespace Omnipay\NMI\Message;

/**
* NMI Direct Post Void Request
*/
class DirectPostVoidRequest extends AbstrastRequest
{
    protected $type = 'void';

    public function getData()
    {
        $this->validate('transactionReference');
        $this->getCard()->validate();

        $data = $this->getBaseData();
        $data['transactionid'] = $this->getTransactionReference();

        return $data;
    }
}
