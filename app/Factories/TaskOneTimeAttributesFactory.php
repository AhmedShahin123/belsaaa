<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:03 PM
 */

namespace App\Factories;


use App\Models\TaskOneTimeAttributes;
use Webmozart\Assert\Assert;

class TaskOneTimeAttributesFactory
{
    public function create(array $data)
    {
        Assert::keyExists($data, 'start_date');
        Assert::keyExists($data, 'start_time');
        Assert::keyExists($data, 'end_time');

        $attributes = $this->initialize($data);
        $attributes->save();

        return $attributes;
    }

    public function initialize(array $data = [])
    {
        $attributes = new TaskOneTimeAttributes();
        $attributes->fill($data);

        return $attributes;
    }
}
