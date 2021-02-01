<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Models\City;

class CityRepository extends BaseRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function allForOptions()
    {
        return array_reduce($this->model->newQuery()->get(['id', 'name'])->toArray(), function ($carry, $item) {
            $carry[$item['id']] = $item['name'];

            return $carry;
        }, []);
    }

    public function update(City $city, array $attributes)
    {
        $city->update($attributes);
    }
}
