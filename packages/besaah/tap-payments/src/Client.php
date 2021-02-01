<?php
/**
 * User: amir
 * Date: 5/6/20
 * Time: 6:23 PM
 */

namespace BeSaah\TapPayments;

use BeSaah\TapPayments\DTO\Authorize\AuthorizeRequest;
use BeSaah\TapPayments\DTO\Authorize\AuthorizeResponse;
use BeSaah\TapPayments\DTO\Card;
use BeSaah\TapPayments\DTO\Charge\ChargeResponse;
use BeSaah\TapPayments\DTO\Customer;
use BeSaah\TapPayments\DTO\Customer\CustomerRequest;
use BeSaah\TapPayments\DTO\Customer\CustomerResponse;
use BeSaah\TapPayments\DTO\Redirect;
use BeSaah\TapPayments\DTO\SavedCard;
use BeSaah\TapPayments\DTO\SavedCardToken\SavedCardTokenRequest;
use BeSaah\TapPayments\DTO\SavedCardToken\SavedCardTokenResponse;
use BeSaah\TapPayments\DTO\Source;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;

class Client
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct($client, $serializer = null)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @param CustomerRequest $customerRequest
     *
     * @return object|CustomerResponse
     *
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function createCustomer(CustomerRequest $customerRequest): CustomerResponse
    {
        $response = $this->client->request('POST', '/v2/customers', [
            'json' => $this->serializer->normalize($customerRequest),
        ]);

        return $this
            ->serializer
            ->deserialize($response->getBody()->getContents(), CustomerResponse::class, 'json')
        ;
    }

    /**
     * @param string $customerId
     * @param string $token
     *
     * @return object|Card
     *
     * @throws GuzzleException
     */
    public function saveCard(string $customerId, string $token): Card
    {
        $response = $this->client->request('POST', '/v2/card/'.$customerId, [
            'json' => [
                'source' => $token,
            ],
        ]);

        return $this
            ->serializer
            ->deserialize($response->getBody()->getContents(), Card::class, 'json');
    }

    /**
     * @param SavedCardTokenRequest $savedCardTokenRequest
     *
     * @return SavedCardTokenResponse|mixed
     *
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function createSavedCardToken(SavedCardTokenRequest $savedCardTokenRequest): SavedCardTokenResponse
    {
        $response = $this->client->request('POST', '/v2/tokens', [
            'json' => $this->serializer->normalize($savedCardTokenRequest),
        ]);

        return $this
            ->serializer
            ->deserialize($response->getBody()->getContents(), SavedCardTokenResponse::class, 'json');
    }

    /**
     * @param float $amount
     * @param string $customerId
     * @param string $cardId
     * @param int $trackingId
     * @return AuthorizeResponse|mixed
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function authorize(float $amount, string $customerId, string $cardId, int $trackingId): AuthorizeResponse
    {
        $savedCardTokenResponse = $this->createSavedCardToken(new SavedCardTokenRequest(new SavedCard($cardId, $customerId)));

        $authorizeRequest = (new AuthorizeRequest())
            ->setSource((new Source())->setId($savedCardTokenResponse->getId()))
            ->setCustomer((new Customer())->setId($customerId))
            ->setAmount($amount)
            ->setRedirect((new Redirect())->setUrl(URL::temporarySignedRoute('payment.callback', now()->addMinutes(30), ['tracking_id' => $trackingId], true)))
        ;

        $response = $this->client->request('POST', '/v2/authorize', [
            'json' => $this->serializer->normalize($authorizeRequest),
        ]);

        return $this
            ->serializer
            ->deserialize($response->getBody()->getContents(), AuthorizeResponse::class, 'json');
    }

    public function charge(string $authorizeId, float $amount, string $customerId): ChargeResponse
    {
        $chargeRequest = (new AuthorizeRequest())
            ->setSource((new Source())->setId($authorizeId))
            ->setCustomer((new Customer())->setId($customerId))
            ->setAmount($amount)
        ;

        $response = $this->client->request('POST', '/v2/charges', [
            'json' => $this->serializer->normalize($chargeRequest),
        ]);

        return $this
            ->serializer
            ->deserialize($response->getBody()->getContents(), ChargeResponse::class, 'json');
    }
}
