<?php

namespace App\Models;

use App\Models\Traits\Relationship\TaskerBankAccountRelationship;
use Illuminate\Database\Eloquent\Model;

class TaskerBankAccount extends Model
{
    use TaskerBankAccountRelationship;

    protected $fillable = ['iban', 'bank_name', 'tasker_attributes_id', 'default'];
}
