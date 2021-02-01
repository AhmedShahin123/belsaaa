<?php
/**
 * User: amir
 * Date: 7/29/20
 * Time: 11:49 AM
 */

namespace App\Factories;


use App\Models\Auth\User;
use App\Models\Interfaces\RateableInterface;

class RatingFactory
{
    public function create(RateableInterface $rateable, $rate, $comment, User $user)
    {
        return \DB::transaction(function () use ($rateable, $rate, $comment, $user) {
            return $rateable->rateOnce($rate, $comment, $user->id);
        });
    }
}
