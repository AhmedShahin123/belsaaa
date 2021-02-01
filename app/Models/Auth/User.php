<?php

namespace App\Models\Auth;

use App\Auth\Contracts\MustVerifyCellphoneInterface;
use App\Auth\Traits\ForgetPasswordByCellphone;
use App\Auth\Traits\MustVerifyCellphone;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Task;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Malhal\Geographical\Geographical;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * Class User.
 *
 * @property EmployerAttributes|TaskerAttributes user_attributes
 * @property int                                 id
 * @property mixed                               user_type
 * @property float                               latitude
 * @property float                               longitude
 * @property string                              company_name
 * @property string                              first_name
 * @property string                              last_name
 * @property string                              email
 * @property string                              cellphone
 * @property string                              tap_customer_id
 * @property int                                 total_rating
 * @property float                               average_rating
 * @property Collection|Task                     invoiced_tasker_tasks
 */
class User extends BaseUser implements MustVerifyCellphoneInterface, HasMedia
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        MustVerifyCellphone,
        HasApiTokens,
        Notifiable,
        HasMediaTrait,
        Geographical,
        ForgetPasswordByCellphone,
        HasRelationships
    ;

    protected static $kilometers = true;

    public function registerMediaCollections()
    {
        $this->addMediaCollection('profile')
            ->useFallbackUrl('/img/anonymous-user.jpg')
            ->useFallbackPath(public_path('/img/anonymous-user.jpg'))
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png']) ;
            });
    }
}
