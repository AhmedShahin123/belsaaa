<?php
/**
 * User: amir
 * Date: 5/6/20
 * Time: 10:18 PM
 */

namespace BeSaah\TapPayments\DTO;

class Phone
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $number;

    public function __construct(string $countryCode, string $number)
    {
        $this->countryCode = $countryCode;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }
}
