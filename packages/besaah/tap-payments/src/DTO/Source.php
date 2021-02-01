<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:13 AM
 */

namespace BeSaah\TapPayments\DTO;


class Source
{
    /**
     * @var string|null
     */
    private $object;

    /**
     * @var string
     */
    private $id;

    /**
     * @return string|null
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * @param string|null $object
     * @return Source
     */
    public function setObject(?string $object): Source
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Source
     */
    public function setId(string $id): Source
    {
        $this->id = $id;

        return $this;
    }
}
