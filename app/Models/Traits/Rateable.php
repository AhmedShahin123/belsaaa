<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 6:54 PM
 */

namespace App\Models\Traits;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Rateable
{
    /**
     * This model has many ratings.
     *
     * @param int    $value
     * @param string $comment
     * @param int    $userId
     *
     * @return Rating
     */
    public function rate(int $value, ?string $comment, int $userId)
    {
        $rating = new Rating();
        $rating->rating = $value;
        $rating->comment = $comment;
        $rating->user_id = $userId;

        $this->ratings()->save($rating);

        return $rating;
    }

    public function rateOnce(int $value, ?string $comment, int $userId): ?Rating
    {
        if (!$this->canRate($userId)) {
            return null;
        }

        /** @var Rating $rating */
        $rating = $this->ratings()
            ->where('user_id', '=', $userId)
            ->first()
        ;

        $oldRate = null;
        if ($rating) {
            $oldRate = $rating->rating;
            $rating->rating = $value;
            $rating->comment = $comment;
            $rating->save();
        } else {
            $isNew = true;
            $rating =$this->rate($value, $comment, $userId);
        }

        $this->aggregateUserRating($rating, $oldRate);

        return $rating;
    }

    /**
     * @return MorphMany
     */
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }

    public function timesRated()
    {
        return $this->ratings()->count();
    }

    public function usersRated()
    {
        return $this->ratings()->groupBy('user_id')->pluck('user_id')->count();
    }

    public function userAverageRating()
    {
        return $this->ratings()->where('user_id', Auth::id())->avg('rating');
    }

    public function userSumRating()
    {
        return $this->ratings()->where('user_id', Auth::id())->sum('rating');
    }

    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    // Getters

    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }

    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }
}
