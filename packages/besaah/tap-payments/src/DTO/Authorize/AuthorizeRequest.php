<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:10 AM
 */

namespace BeSaah\TapPayments\DTO\Authorize;


use BeSaah\TapPayments\DTO\Customer;
use BeSaah\TapPayments\DTO\Redirect;
use BeSaah\TapPayments\DTO\Source;

class AuthorizeRequest
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency = 'SAR';

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var Source
     */
    protected $source;

    /**
     * @var Redirect|null
     */
    protected $redirect;

    /**
     * @return Redirect|null
     */
    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }

    /**
     * @param Redirect|null $redirect
     * @return AuthorizeRequest
     */
    public function setRedirect(?Redirect $redirect): AuthorizeRequest
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return AuthorizeRequest
     */
    public function setAmount(float $amount): AuthorizeRequest
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return AuthorizeRequest
     */
    public function setCurrency(string $currency): AuthorizeRequest
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return AuthorizeRequest
     */
    public function setCustomer(Customer $customer): AuthorizeRequest
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Source
     */
    public function getSource(): ?Source
    {
        return $this->source;
    }

    /**
     * @param Source $source
     * @return AuthorizeRequest
     */
    public function setSource(Source $source): AuthorizeRequest
    {
        $this->source = $source;

        return $this;
    }
}
