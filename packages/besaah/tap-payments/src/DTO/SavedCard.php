<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:41 AM
 */

namespace BeSaah\TapPayments\DTO;

class SavedCard
{
    /**
     * @var string
     */
    private $cardId;

    /**
     * @var string
     */
    private $customerId;

    public function __construct(string $cardId, string $customerId)
    {
        $this->cardId = $cardId;
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getCardId(): ?string
    {
        return $this->cardId;
    }

    /**
     * @return string
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
}
