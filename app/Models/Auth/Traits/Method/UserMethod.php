<?php

namespace App\Models\Auth\Traits\Method;

use App\Models\Invoice;
use App\Models\Task;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\File;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Webmozart\Assert\Assert;


/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @param bool $size
     *
     * @throws \Illuminate\Container\EntryNotFoundException
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getPicture($size = false)
    {
        switch ($this->avatar_type) {
            case 'gravatar':
                if (! $size) {
                    $size = config('gravatar.default.size');
                }

                return gravatar()->get($this->email, ['size' => $size]);

            case 'storage':
                return url('storage/'.$this->avatar_location);
        }

        $social_avatar = $this->providers()->where('provider', $this->avatar_type)->first();

        if ($social_avatar && strlen($social_avatar->avatar)) {
            return $social_avatar->avatar;
        }

        return false;
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->hasRole(config('access.users.admin_role'));
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return config('access.users.requires_approval') && ! $this->confirmed;
    }

    /**
     * @return HasManyDeep
     */
    public function invoiced_tasker_tasks()
    {
        return $this->hasManyDeepFromRelations($this->tasker_invoices(), (new Invoice())->task());
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['photo_url'] = $this->photo_url;
        if ($this->user_type === 'employer') {
            $data['employer_commission_not_paid_amount'] = $this->employer_commission_not_paid_invoices()->sum('commission');
        }

        return $data;
    }

    public function routeNotificationForFcm($notification)
    {
        $tokens = $this->devices->pluck('fcm_token')->toArray();

        return $tokens;
    }

    public function finishedTaskCount()
    {
        if ($this->user_type === 'tasker') {
            return $this->tasker_invoices()->count();
        } elseif ($this->user_type === 'employer') {
            return $this->employer_invoices()->count();
        }
    }

    public function totalEarned()
    {
        Assert::eq('tasker', $this->user_type);
        return $this->tasker_invoices()->getQuery()->sum('tasker_amount');
    }

    public function totalPaid()
    {
        Assert::eq('employer', $this->user_type);

        $commissionPaid = $this->employer_commission_paid_invoices()->sum('commission');
        $taskerAmountPaid = $this->employer_tasker_amount_paid_invoices()->sum('tasker_amount');

        return $commissionPaid + $taskerAmountPaid;
    }

    public function totalMustPay()
    {
        Assert::eq('employer', $this->user_type);

        $commissionNotPaid = $this->employer_commission_not_paid_invoices()->sum('commission');
        $taskerAmountNotPaid = $this->employer_tasker_amount_not_paid_invoices()->sum('tasker_amount');

        return $commissionNotPaid + $taskerAmountNotPaid;
    }

    public function notClearedTaskerAmount()
    {
        Assert::eq('tasker', $this->user_type);

        return $this->tasker_invoices_not_cleared()->online()->sum('tasker_amount');
    }

    public function routeNotificationForSms($notification)
    {
        return $this->cellphone;
    }

    public function addRate(int $rate, ?int $oldRate = null)
    {
        $oldTotalRating = $this->total_rating ?? 0;
        $oldAverageRating = $this->average_rating ?? 0;
        $oldCount = $this->average_rating != 0 ? ((int) $oldTotalRating / $oldAverageRating) : 0;

        if ($oldRate === null) { // Is new rating
            $newTotalRating = $oldTotalRating + $rate;
            $newAverageRating = (float) $newTotalRating / ($oldCount + 1);
        } else {
            $newTotalRating = max(0, $oldTotalRating - $oldRate + $rate);
            $newAverageRating = (float) $newTotalRating / $oldCount;
        }

        $this->total_rating = $newTotalRating;
        $this->average_rating = $newAverageRating;

        $this->save();
    }
}
