<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 12:03 AM
 */

namespace BeSaah\TapPayments\Denormalizer;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class MicrotimeDenormalizer implements DenormalizerInterface
{
    /**
     * @var DateTimeNormalizer
     */
    private $decoratedDateTimeDenormalizer;

    public function __construct(DateTimeNormalizer $decoratedDateTimeDenormalizer)
    {
        $this->decoratedDateTimeDenormalizer = $decoratedDateTimeDenormalizer;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return $this->decoratedDateTimeDenormalizer->denormalize(
            (new \DateTime())->setTimestamp(substr($data, 0, 10))->format('Y-m-d H:i:s'),
            $type,
            $format,
            $context
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return \is_string($data) &&
            \is_numeric($data) &&
            (\strlen($data) === 13 || \strlen($data) === 10) &&
            $this->decoratedDateTimeDenormalizer->supportsDenormalization($data, $type, $format);
    }
}
