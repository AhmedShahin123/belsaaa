<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 3:03 AM
 */

namespace App\Auth\OAuth;

use App\Events\Auth\GeneratingBearerTokenResponse;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse;
use Psr\Http\Message\ResponseInterface;

class ResponseType extends BearerTokenResponse
{
    public function generateHttpResponse(ResponseInterface $response)
    {
        return parent::generateHttpResponse($response);
    }
}
