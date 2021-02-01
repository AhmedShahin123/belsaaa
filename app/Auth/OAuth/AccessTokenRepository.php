<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 3:30 AM
 */

namespace App\Auth\OAuth;

use League\OAuth2\Server\Entities\ClientEntityInterface;

class AccessTokenRepository extends \Laravel\Passport\Bridge\AccessTokenRepository
{
    /**
     * {@inheritdoc}
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessToken($userIdentifier, $scopes, $clientEntity);
    }
}
