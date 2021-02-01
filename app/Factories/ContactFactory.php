<?php
/**
 * User: amir
 * Date: 3/24/20
 * Time: 4:29 AM
 */

namespace App\Factories;


use App\Models\Contact;

class ContactFactory
{
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }
}
