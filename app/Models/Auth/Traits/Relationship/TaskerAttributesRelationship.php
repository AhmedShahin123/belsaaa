<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 3:54 PM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\TaskerWorkingDay;
use App\Models\Auth\User;
use App\Models\Skill;
use App\Models\TaskerBankAccount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait TaskerAttributesRelationship
 *
 * @property Collection|TaskerWorkingDay[] working_days
 */
trait TaskerAttributesRelationship
{
    /**
     * @return BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'tasker_skills', 'tasker_attributes_id', 'skill_id');
    }

    /**
     * @return HasMany
     */
    public function working_days()
    {
        return $this->hasMany(TaskerWorkingDay::class);
    }

    /**
     * @return HasMany
     */
    public function tasker_bank_accounts()
    {
        return $this->hasMany(TaskerBankAccount::class);
    }

    public function tasker()
    {
        return $this->morphMany(User::class, 'user_attributes', 'user_type', 'attributes_id');
    }
}
