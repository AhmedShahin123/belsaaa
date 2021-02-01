<?php
/**
 * User: amir
 * Date: 7/29/20
 * Time: 11:38 AM
 */

namespace App\Models\Interfaces;

use App\Models\Auth\User;
use App\Models\Rating;

interface RateableInterface
{
    public function rateOnce(int $value, ?string $comment, int $userId): ?Rating;

    public function canRate(int $userId);

    public function aggregateUserRating(Rating $rating, ?int $oldRate = null);
}
