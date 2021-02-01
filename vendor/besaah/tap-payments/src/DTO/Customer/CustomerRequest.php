<?php
/**
 * User: amir
 * Date: 5/6/20
 * Time: 10:17 PM
 */

namespace BeSaah\TapPayments\DTO\Customer;

use BeSaah\TapPayments\DTO\Phone;

class CustomerRequest
{
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


    public function __construct(string $firstName, string $lastName, string $email, Phone $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return Phone
     */
    public function getPhone(): ?Phone
    {
        return $this->phone;
    }
}
