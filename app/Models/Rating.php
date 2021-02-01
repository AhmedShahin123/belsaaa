<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 6:54 PM
 */

namespace App\Models;


use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rating
 *
 * @property string comment
 * @property int    rating
 * @property int    user_id
 */
class Rating extends Model
{
    protected $fillable = ['rating', 'comment'];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
