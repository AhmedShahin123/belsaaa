<?php

namespace BeSaah\TapPayments;

use BeSaah\TapPayments\Denormalizer\MicrotimeDenormalizer;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TapPaymentsProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tap_payments.php' => config_path('tap_payments.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tap_payments.php', 'tap_payments'
        );

        $this->app->singleton(Client::class, function () {
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $dateTimeNormalizer = new DateTimeNormalizer();
            $normalizers = [
                new MicrotimeDenormalizer($dateTimeNormalizer),
                $dateTimeNormalizer,
                new ObjectNormalizer(
                    null,
                    new CamelCaseToSnakeCaseNameConverter(),
                    null,
                    new ReflectionExtractor()
                )
            ];

            $serializer = new Serializer($normalizers, $encoders);

            return new Client($this->makeGuzzleClient(), $serializer);
        });
    }

    protected function makeGuzzleClient()
    {
        return new \GuzzleHttp\Client([
            'base_uri' => 'https://api.tap.company/',
            'headers' => [
                'Authorization' => 'Bearer '.config('tap_payments.secret_api_key'),
            ],
        ]);
    }
}
