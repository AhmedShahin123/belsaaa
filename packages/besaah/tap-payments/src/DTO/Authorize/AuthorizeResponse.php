<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 5:08 AM
 */

namespace BeSaah\TapPayments\DTO\Authorize;

use BeSaah\TapPayments\DTO\Card;
use BeSaah\TapPayments\DTO\Customer;
use BeSaah\TapPayments\DTO\Redirect;
use BeSaah\TapPayments\DTO\Source;
use BeSaah\TapPayments\DTO\Transaction;

class AuthorizeResponse
{
    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $object;

    /**
     * @var boolean|null
     */
    protected $liveMode;

    /**
     * @var string|null
     */
    protected $apiVersion;

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var float|null
     */
    protected $amount;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var boolean|null
     */
    protected $threeDSecure;

    /**
     * @var boolean|null
     */
    protected $savedCard;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string|null
     */
    protected $statementDescriptor;

    /**
     * @var Transaction|null
     */
    protected $transaction;

    /**
     * @var array|null
     */
    protected $reference;

    /**
     * @var array|null
     */
    protected $metadata;

    /**
     * @var array|null
     */
    protected $response;

    /**
     * @var array|null
     */
    protected $receipt;

    /**
     * @var Customer|null
     */
    protected $customer;

    /**
     * @var Source|null
     */
    protected $source;

    /**
     * @var array|null
     */
    protected $auto;

    /**
     * @var array|null
     */
    protected $void;

    /**
     * @var array|null
     */
    protected $capture;

    /**
     * @var array|null
     */
    protected $security;

    /**
     * @var array|null
     */
    protected $acquirer;

    /**
     * @var Card|null
     */
    protected $card;

    /**
     * @var array|null
     */
    protected $airline;

    /**
     * @var array|null
     */
    protected $post;

    /**
     * @var Redirect|null
     */
    protected $redirect;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return AuthorizeResponse
     */
    public function setId(?string $id): AuthorizeResponse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * @param string|null $object
     * @return AuthorizeResponse
     */
    public function setObject(?string $object): AuthorizeResponse
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLiveMode(): ?bool
    {
        return $this->liveMode;
    }

    /**
     * @param bool|null $liveMode
     * @return AuthorizeResponse
     */
    public function setLiveMode(?bool $liveMode): AuthorizeResponse
    {
        $this->liveMode = $liveMode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @param string|null $apiVersion
     * @return AuthorizeResponse
     */
    public function setApiVersion(?string $apiVersion): AuthorizeResponse
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return AuthorizeResponse
     */
    public function setStatus(?string $status): AuthorizeResponse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     * @return AuthorizeResponse
     */
    public function setAmount(?float $amount): AuthorizeResponse
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return AuthorizeResponse
     */
    public function setCurrency(?string $currency): AuthorizeResponse
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getThreeDSecure(): ?bool
    {
        return $this->threeDSecure;
    }

    /**
     * @param bool|null $threeDSecure
     * @return AuthorizeResponse
     */
    public function setThreeDSecure(?bool $threeDSecure): AuthorizeResponse
    {
        $this->threeDSecure = $threeDSecure;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSavedCard(): ?bool
    {
        return $this->savedCard;
    }

    /**
     * @param bool|null $savedCard
     * @return AuthorizeResponse
     */
    public function setSavedCard(?bool $savedCard): AuthorizeResponse
    {
        $this->savedCard = $savedCard;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return AuthorizeResponse
     */
    public function setDescription(?string $description): AuthorizeResponse
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    /**
     * @param string|null $statementDescriptor
     * @return AuthorizeResponse
     */
    public function setStatementDescriptor(?string $statementDescriptor): AuthorizeResponse
    {
        $this->statementDescriptor = $statementDescriptor;

        return $this;
    }

    /**
     * @return Transaction|null
     */
    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    /**
     * @param Transaction|null $transaction
     * @return AuthorizeResponse
     */
    public function setTransaction(?Transaction $transaction): AuthorizeResponse
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getReference(): ?array
    {
        return $this->reference;
    }

    /**
     * @param array|null $reference
     * @return AuthorizeResponse
     */
    public function setReference(?array $reference): AuthorizeResponse
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param array|null $metadata
     * @return AuthorizeResponse
     */
    public function setMetadata(?array $metadata): AuthorizeResponse
    {
        $this->metadata = $metadata;

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
     * @return AuthorizeResponse
     */
    public function setResponse(?array $response): AuthorizeResponse
    {
        $this->response = $response;

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
     * @return AuthorizeResponse
     */
    public function setReceipt(?array $receipt): AuthorizeResponse
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
     * @return AuthorizeResponse
     */
    public function setCustomer(?Customer $customer): AuthorizeResponse
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
     * @return AuthorizeResponse
     */
    public function setSource(?Source $source): AuthorizeResponse
    {
        $this->source = $source;

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
     * @return AuthorizeResponse
     */
    public function setAuto(?array $auto): AuthorizeResponse
    {
        $this->auto = $auto;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getVoid(): ?array
    {
        return $this->void;
    }

    /**
     * @param array|null $void
     * @return AuthorizeResponse
     */
    public function setVoid(?array $void): AuthorizeResponse
    {
        $this->void = $void;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCapture(): ?array
    {
        return $this->capture;
    }

    /**
     * @param array|null $capture
     * @return AuthorizeResponse
     */
    public function setCapture(?array $capture): AuthorizeResponse
    {
        $this->capture = $capture;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSecurity(): ?array
    {
        return $this->security;
    }

    /**
     * @param array|null $security
     * @return AuthorizeResponse
     */
    public function setSecurity(?array $security): AuthorizeResponse
    {
        $this->security = $security;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAcquirer(): ?array
    {
        return $this->acquirer;
    }

    /**
     * @param array|null $acquirer
     * @return AuthorizeResponse
     */
    public function setAcquirer(?array $acquirer): AuthorizeResponse
    {
        $this->acquirer = $acquirer;

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
     * @return AuthorizeResponse
     */
    public function setCard(?Card $card): AuthorizeResponse
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAirline(): ?array
    {
        return $this->airline;
    }

    /**
     * @param array|null $airline
     * @return AuthorizeResponse
     */
    public function setAirline(?array $airline): AuthorizeResponse
    {
        $this->airline = $airline;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPost(): ?array
    {
        return $this->post;
    }

    /**
     * @param array|null $post
     * @return AuthorizeResponse
     */
    public function setPost(?array $post): AuthorizeResponse
    {
        $this->post = $post;

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
     * @return AuthorizeResponse
     */
    public function setRedirect(?Redirect $redirect): AuthorizeResponse
    {
        $this->redirect = $redirect;

        return $this;
    }
}
