<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:43 AM
 */

namespace App\Models\Traits\Relationship;


use Altek\Eventually\Relations\BelongsToMany;
use App\Models\CreditCard;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PaymentRelationship
{
    /**
     * @return BelongsToMany
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    /**
     * @return BelongsTo
     */
    public function credit_card()
    {
        return $this->belongsTo(CreditCard::class);
    }
}
