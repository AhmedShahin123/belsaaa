<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:03 PM
 */

namespace App\Factories;


use App\Models\TaskContinuedAttributes;
use Webmozart\Assert\Assert;

class TaskContinuedAttributesFactory
{
    public function create(array $data)
    {
        Assert::keyExists($data, 'start_at');
        Assert::keyExists($data, 'daily_duration');
        Assert::keyExists($data, 'end_date');

        $attributes = $this->initialize($data);
        $attributes->save();

        return $attributes;
    }

    public function initialize(array $data = [])
    {
        $attributes = new TaskContinuedAttributes();
        $attributes->fill($data);

        return $attributes;
    }
}
