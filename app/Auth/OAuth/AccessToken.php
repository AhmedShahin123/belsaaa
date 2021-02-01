<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 3:30 AM
 */

namespace App\Auth\OAuth;

use App\Events\Auth\BuildingJWT;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;
use League\OAuth2\Server\CryptKey;

class AccessToken extends \Laravel\Passport\Bridge\AccessToken
{

    /**
     * @var CryptKey
     */
    private $privateKey;

    /**
     * Set the private key used to encrypt this access token.
     */
    public function setPrivateKey(CryptKey $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * Generate a JWT from the access token
     *
     * @param CryptKey $privateKey
     *
     * @return Token
     */
    private function convertToJWT(CryptKey $privateKey)
    {
        $builder = (new Builder())
            ->setAudience($this->getClient()->getIdentifier())
            ->setId($this->getIdentifier())
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration($this->getExpiryDateTime()->getTimestamp())
            ->setSubject((string) $this->getUserIdentifier())
            ->set('scopes', $this->getScopes())
            ->sign(new Sha256(), new Key($privateKey->getKeyPath(), $privateKey->getPassPhrase()));

        event(new BuildingJWT($this, $builder));

        return $builder->getToken();
    }

    /**
     * Generate a string representation from the access token
     */
    public function __toString()
    {
        return (string) $this->convertToJWT($this->privateKey);
    }
}
