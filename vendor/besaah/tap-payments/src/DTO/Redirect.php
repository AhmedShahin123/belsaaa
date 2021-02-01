<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:53 AM
 */

namespace BeSaah\TapPayments\DTO;


class Redirect
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Redirect
     */
    public function setStatus(?string $status): Redirect
    {
        $this->status = $status;

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
     * @return Redirect
     */
    public function setUrl(?string $url): Redirect
    {
        $this->url = $url;

        return $this;
    }
}
