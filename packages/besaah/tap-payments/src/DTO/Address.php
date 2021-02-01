<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:52 AM
 */

namespace BeSaah\TapPayments\DTO;

class Address
{
    /**
     * @var string|null
     */
    private $country;

    /**
     * @var string|null
     */
    private $line1;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $avenue;

    public function __construct(
        string $country = null,
        string $line1 = null,
        string $city = null,
        string $street = null,
        string $avenue = null
    ) {
        $this->country = $country;
        $this->line1 = $line1;
        $this->city = $city;
        $this->street = $street;
        $this->avenue = $avenue;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getLine1(): ?string
    {
        return $this->line1;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getAvenue(): ?string
    {
        return $this->avenue;
    }
}
