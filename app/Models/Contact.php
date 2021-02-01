<?php

namespace App\Models;

use App\Models\Traits\Relationship\ContactRelationship;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use ContactRelationship;

    protected $fillable = ['subject', 'category_id', 'email', 'body'];
}
