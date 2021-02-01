<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 4:05 PM
 */

namespace App\Repositories;

use App\Models\City;
use App\Models\Skill;

class SkillRepository extends BaseRepository
{
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }

    public function update(Skill $skill, array $attributes)
    {
        $skill->update($attributes);
    }
}
