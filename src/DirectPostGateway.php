<?php
namespace Omnipay\NMI;

use Omnipay\Common\AbstractGateway;

/**
 * NMI
 *
 * @link https://www.nmi.com/
 * @link https://gateway.perpetualpayments.com/merchants/resources/integration/integration_portal.php
 */
class DirectPostGateway extends AbstractGateway {
    /**
     * @return string
     */
    public function getName()
    {
        return 'NMI Direct Post';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => ''
        );
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * @param  string $value
     * @return $this
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param  string $value
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Transaction sales are submitted and immediately flagged for settlement.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostSaleRequest
     */
    public function sale(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostSaleRequest', $parameters);
    }

    /**
     * Transaction authorizations are authorized immediately but are not flagged
     * for settlement. These transactions must be flagged for settlement using
     * the capture transaction type. Authorizations typically remain active for
     * three to seven business days.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostAuthRequest
     */
    public function auth(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostAuthRequest', $parameters);
    }

    /**
     * Transaction captures flag existing authorizations for settlement.
     * Only authorizations can be captured. Captures can be submitted for an
     * amount equal to or less than the original authorization.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostCaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostCaptureRequest', $parameters);
    }

    /**
     * Transaction voids will cancel an existing sale or captured authorization.
     * In addition, non-captured authorizations can be voided to prevent any
     * future capture. Voids can only occur if the transaction has not been settled.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostVoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostVoidRequest', $parameters);
    }

    /**
     * Transaction refunds will reverse a previously settled transaction. If the
     * transaction has not been settled, it must be voided instead of refunded.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostRefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostRefundRequest', $parameters);
    }

    /**
     * Transaction credits apply an amount to the cardholder's card that was not
     * originally processed through the Gateway. In most situations credits are
     * disabled as transaction refunds should be used instead.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostCreditRequest
     */
    public function credit(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostCreditRequest', $parameters);
    }

    /**
     * This action is used for doing an "Account Verification" on the
     * cardholder's credit card without actually doing an authorization.
     * @param  array  $parameters
     * @return \Omnipay\NMI\Message\DirectPostValidateRequest
     */
    public function validate(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\NMI\Message\DirectPostValidateRequest', $parameters);
    }
}
