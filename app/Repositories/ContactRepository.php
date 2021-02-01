<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function update(Contact $contact, array $attributes)
    {
        $contact->update($attributes);
    }
}
