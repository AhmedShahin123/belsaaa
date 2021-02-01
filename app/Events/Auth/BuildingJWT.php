<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 3:10 AM
 */

namespace App\Events\Auth;

use Laravel\Passport\Bridge\AccessToken;
use Lcobucci\JWT\Builder;

class BuildingJWT
{
    /**
     * @var AccessToken
     */
    public $accessToken;

    /**
     * @var Builder
     */
    public $builder;

    /**
     * GeneratingBearerTokenResponse constructor.
     *
     * @param AccessToken $accessToken
     * @param Builder     $builder
     */
    public function __construct(AccessToken $accessToken, Builder $builder)
    {
        $this->accessToken = $accessToken;
        $this->builder = $builder;
    }
}
