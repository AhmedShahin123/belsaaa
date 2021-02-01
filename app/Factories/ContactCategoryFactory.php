<?php
/**
 * User: amir
 * Date: 3/24/20
 * Time: 4:29 AM
 */

namespace App\Factories;


use App\Models\ContactCategory;

class ContactCategoryFactory
{
    public function create($name): ContactCategory
    {
        return ContactCategory::create(['name' => $name]);
    }

    public function initialize(): ContactCategory
    {
        return new ContactCategory();
    }
}
