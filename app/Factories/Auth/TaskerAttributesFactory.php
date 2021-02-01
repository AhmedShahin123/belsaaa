<?php
/**
 * User: amir
 * Date: 1/29/20
 * Time: 12:53 PM
 */

namespace App\Factories\Auth;


use App\Models\Auth\TaskerAttributes;

class TaskerAttributesFactory
{
    public function create($attributes)
    {
        $taskerAttributes = $this->initialize($attributes);
        $taskerAttributes->save();

        return $taskerAttributes;
    }

    public function initialize($attributes)
    {
        $taskerAttributes = new TaskerAttributes();
        $taskerAttributes->fill($attributes);

        return $taskerAttributes;
    }
}
