<?php

namespace App\MessageHandler;

use App\Message\SyncMessage;
use RuntimeException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class SyncMessageHandler
{
    #[AsMessageHandler(bus: 'internal.bus')]
    public function handleSyncMessage(SyncMessage $message): void
    {
        if ($message->throw) {
            throw new RuntimeException('Error!');
        }
    }
}
