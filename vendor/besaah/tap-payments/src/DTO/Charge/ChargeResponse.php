<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 5:44 AM
 */

namespace BeSaah\TapPayments\DTO\Charge;


use BeSaah\TapPayments\DTO\Authorize\AuthorizeResponse;

class ChargeResponse extends AuthorizeResponse
{
    /**
     * @var array|null
     */
    private $merchantPayouts;

    /**
     * @var array|null
     */
    private $applications;

    /**
     * @var array|null
     */
    private $destinations;

    /**
     * @return array|null
     */
    public function getMerchantPayouts(): ?array
    {
        return $this->merchantPayouts;
    }

    /**
     * @param array|null $merchantPayouts
     * @return ChargeResponse
     */
    public function setMerchantPayouts(?array $merchantPayouts): ChargeResponse
    {
        $this->merchantPayouts = $merchantPayouts;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getApplications(): ?array
    {
        return $this->applications;
    }

    /**
     * @param array|null $applications
     * @return ChargeResponse
     */
    public function setApplications(?array $applications): ChargeResponse
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDestinations(): ?array
    {
        return $this->destinations;
    }

    /**
     * @param array|null $destinations
     * @return ChargeResponse
     */
    public function setDestinations(?array $destinations): ChargeResponse
    {
        $this->destinations = $destinations;

        return $this;
    }
}
