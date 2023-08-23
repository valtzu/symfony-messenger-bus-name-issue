<?php

namespace App\Messenger;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

/**
 * This is just to simulate external message source which is missing all the stamps
 */
class StampRemovingSerializer implements SerializerInterface
{
    public function __construct(
        #[Autowire(service: 'messenger.transport.symfony_serializer')]
        private readonly SerializerInterface $inner
    ) {
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        return $this->inner->decode($encodedEnvelope);
    }

    public function encode(Envelope $envelope): array
    {
        return ['headers' => ['type' => get_class($envelope->getMessage())]] + $this->inner->encode($envelope);
    }
}
