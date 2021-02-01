<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:12 AM
 */

namespace BeSaah\TapPayments\DTO;

class Customer
{
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
    private $middleName;

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
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Customer
     */
    public function setId(string $id): Customer
    {
        $this->id = $id;

        return $this;
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
     * @return Customer
     */
    public function setFirstName(string $firstName): Customer
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return Customer
     */
    public function setMiddleName(string $middleName): Customer
    {
        $this->middleName = $middleName;

        return $this;
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
     * @return Customer
     */
    public function setLastName(string $lastName): Customer
    {
        $this->lastName = $lastName;

        return $this;
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
     * @return Customer
     */
    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
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
     * @return Customer
     */
    public function setPhone(Phone $phone): Customer
    {
        $this->phone = $phone;

        return $this;
    }
}
