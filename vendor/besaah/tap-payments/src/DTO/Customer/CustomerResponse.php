<?php
/**
 * User: amir
 * Date: 5/6/20
 * Time: 11:25 PM
 */

namespace BeSaah\TapPayments\DTO\Customer;

use BeSaah\TapPayments\DTO\Phone;

class CustomerResponse
{
    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @return \DateTime
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
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
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Phone
     */
    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }
}
