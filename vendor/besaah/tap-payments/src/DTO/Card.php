<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:58 AM
 */

namespace BeSaah\TapPayments\DTO;

class Card
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $object;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var string
     */
    private $funding;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var integer
     */
    private $expMonth;

    /**
     * @var integer
     */
    private $expYear;

    /**
     * @var string
     */
    private $lastFour;

    /**
     * @var string
     */
    private $firstSix;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     */
    public function setCustomer(string $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getFunding(): ?string
    {
        return $this->funding;
    }

    /**
     * @param string $funding
     */
    public function setFunding(string $funding): void
    {
        $this->funding = $funding;
    }

    /**
     * @return string
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getLastFour(): ?string
    {
        return $this->lastFour;
    }

    /**
     * @param string $lastFour
     */
    public function setLastFour(string $lastFour): void
    {
        $this->lastFour = $lastFour;
    }

    /**
     * @return string
     */
    public function getFirstSix(): ?string
    {
        return $this->firstSix;
    }

    /**
     * @param string $firstSix
     */
    public function setFirstSix(string $firstSix): void
    {
        $this->firstSix = $firstSix;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    /**
     * @return Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     */
    public function setFingerprint(string $fingerprint): void
    {
        $this->fingerprint = $fingerprint;
    }

    /**
     * @return int
     */
    public function getExpMonth(): ?int
    {
        return $this->expMonth;
    }

    /**
     * @param int $expMonth
     */
    public function setExpMonth(int $expMonth): void
    {
        $this->expMonth = $expMonth;
    }

    /**
     * @return int
     */
    public function getExpYear(): ?int
    {
        return $this->expYear;
    }

    /**
     * @param int $expYear
     */
    public function setExpYear(int $expYear): void
    {
        $this->expYear = $expYear;
    }
}
