<?php
namespace Omnipay\NMI\Message;

/**
* NMI Direct Post Validate Request
*/
class DirectPostValidateRequest extends DirectPostAuthRequest
{
    protected $type = 'validate';
}
