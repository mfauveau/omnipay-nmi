<?php
namespace Omnipay\NMI;

use Omnipay\Common\AbstractGateway;

/**
 * NMI
 *
 * @link https://www.nmi.com/
 */
class Gateway extends AbstractGateway {
    /**
     * @return string
     */
    public function getName()
    {
        return 'NMI';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
        );
    }

}
