<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 5:10 AM
 */

namespace BeSaah\TapPayments\DTO;


class Transaction
{
    /**
     * @var string|null
     */
    private $timezone;

    /**
     * @var string|null
     */
    private $created;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var array|null
     */
    private $expiry;

    /**
     * @var boolean|null
     */
    private $asynchronous;

    /**
     * @var integer|float|null
     */
    private $amount;

    /**
     * @var array|null
     */
    private $response;

    /**
     * @var Card|null
     */
    private $card;

    /**
     * @var array|null
     */
    private $receipt;

    /**
     * @var Customer|null
     */
    private $customer;

    /**
     * @var Source|null
     */
    private $source;

    /**
     * @var Redirect|null
     */
    private $redirect;

    /**
     * @var array|null
     */
    private $auto;

    /**
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * @param string|null $timezone
     * @return Transaction
     */
    public function setTimezone(?string $timezone): Transaction
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreated(): ?string
    {
        return $this->created;
    }

    /**
     * @param string|null $created
     * @return Transaction
     */
    public function setCreated(?string $created): Transaction
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return Transaction
     */
    public function setUrl(?string $url): Transaction
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getExpiry(): ?array
    {
        return $this->expiry;
    }

    /**
     * @param array|null $expiry
     * @return Transaction
     */
    public function setExpiry(?array $expiry): Transaction
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAsynchronous(): ?bool
    {
        return $this->asynchronous;
    }

    /**
     * @param bool|null $asynchronous
     * @return Transaction
     */
    public function setAsynchronous(?bool $asynchronous): Transaction
    {
        $this->asynchronous = $asynchronous;

        return $this;
    }

    /**
     * @return int|float|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int|null $amount
     * @return Transaction
     */
    public function setAmount($amount): Transaction
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getResponse(): ?array
    {
        return $this->response;
    }

    /**
     * @param array|null $response
     * @return Transaction
     */
    public function setResponse(?array $response): Transaction
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return Card|null
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * @param Card|null $card
     * @return Transaction
     */
    public function setCard(?Card $card): Transaction
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getReceipt(): ?array
    {
        return $this->receipt;
    }

    /**
     * @param array|null $receipt
     * @return Transaction
     */
    public function setReceipt(?array $receipt): Transaction
    {
        $this->receipt = $receipt;

        return $this;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     * @return Transaction
     */
    public function setCustomer(?Customer $customer): Transaction
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Source|null
     */
    public function getSource(): ?Source
    {
        return $this->source;
    }

    /**
     * @param Source|null $source
     * @return Transaction
     */
    public function setSource(?Source $source): Transaction
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Redirect|null
     */
    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }

    /**
     * @param Redirect|null $redirect
     * @return Transaction
     */
    public function setRedirect(?Redirect $redirect): Transaction
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAuto(): ?array
    {
        return $this->auto;
    }

    /**
     * @param array|null $auto
     * @return Transaction
     */
    public function setAuto(?array $auto): Transaction
    {
        $this->auto = $auto;

        return $this;
    }
}
