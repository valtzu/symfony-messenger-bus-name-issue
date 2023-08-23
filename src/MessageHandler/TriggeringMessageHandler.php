<?php

namespace App\MessageHandler;

use App\Message\SyncMessage;
use App\Message\TriggeringMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class TriggeringMessageHandler
{
    public function __construct(
        private readonly MessageBusInterface $internalBus,
    ) {
    }

    #[AsMessageHandler(bus: 'external.bus', handles: TriggeringMessage::class)]
    public function handleTriggeringMessage(): void
    {
        $this->internalBus->dispatch(new SyncMessage(throw: false), [new DispatchAfterCurrentBusStamp()]);
        $this->internalBus->dispatch(new SyncMessage(throw: true), [new DispatchAfterCurrentBusStamp()]);
    }
}
