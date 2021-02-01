<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:51 AM
 */

namespace App\Models\Traits\Scope;


use Illuminate\Database\Eloquent\Builder;

trait CreditCardScope
{
    public function scopeById(Builder $query, $id)
    {
        return $query->where('credit_cards.id', $id);
    }

    public function scopeByUserId(Builder $query, $userId)
    {
        return $query->where('credit_cards.user_id', $userId);
    }

    public function scopeByOtherUserId(Builder $query, $userId)
    {
        return $query->where('credit_cards.user_id', '<>', $userId);
    }

    public function scopeByFingerprint(Builder $query, $fingerprint)
    {
        return $query->where('credit_cards.fingerprint', $fingerprint);
    }
}
