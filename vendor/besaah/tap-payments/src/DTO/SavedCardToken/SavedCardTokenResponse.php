<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:01 AM
 */

namespace BeSaah\TapPayments\DTO\SavedCardToken;


use BeSaah\TapPayments\DTO\Card;

class SavedCardTokenResponse
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
     * @var string|null
     */
    private $clientIp;

    /**
     * @var integer
     */
    private $created;

    /**
     * @var boolean
     */
    private $liveMode;

    /**
     * @var string
     */
    private $type;

    /**
     * @var boolean
     */
    private $used;

    /**
     * @var Card
     */
    private $card;

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
     * @return string
     */
    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     */
    public function setClientIp(?string $clientIp): void
    {
        $this->clientIp = $clientIp;
    }

    /**
     * @return int
     */
    public function getCreated(): ?int
    {
        return $this->created;
    }

    /**
     * @param int $created
     */
    public function setCreated(int $created): void
    {
        $this->created = $created;
    }

    /**
     * @return bool
     */
    public function isLiveMode(): ?bool
    {
        return $this->liveMode;
    }

    /**
     * @param bool $liveMode
     */
    public function setLiveMode(bool $liveMode): void
    {
        $this->liveMode = $liveMode;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isUsed(): ?bool
    {
        return $this->used;
    }

    /**
     * @param bool $used
     */
    public function setUsed(bool $used): void
    {
        $this->used = $used;
    }

    /**
     * @return Card
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * @param Card $card
     */
    public function setCard(Card $card): void
    {
        $this->card = $card;
    }
}
