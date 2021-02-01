<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\Traits\Relationship\CreditCartRelationship;
use App\Models\Traits\Scope\CreditCardScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CreditCard
 *
 * @property string brand
 * @property string name
 * @property string first_six
 * @property string last_four
 * @property int    user_id
 * @property User   user
 * @property string tap_card_id
 */
class CreditCard extends Model
{
    use CreditCartRelationship, CreditCardScope;

    protected $fillable = ['brand', 'name', 'first_six', 'last_four', 'user_id', 'tap_card_id', 'fingerprint'];

    protected $hidden = ['tap_card_id'];
}
