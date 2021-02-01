<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:41 AM
 */

namespace BeSaah\TapPayments\DTO\SavedCardToken;

use BeSaah\TapPayments\DTO\SavedCard;

class SavedCardTokenRequest
{
    /**
     * @var SavedCard
     */
    private $savedCard;

    public function __construct(SavedCard $savedCard)
    {
        $this->savedCard = $savedCard;
    }

    /**
     * @return SavedCard
     */
    public function getSavedCard(): ?SavedCard
    {
        return $this->savedCard;
    }
}
