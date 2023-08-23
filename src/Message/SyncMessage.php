<?php

namespace App\Message;

class SyncMessage
{
    public function __construct(public bool $throw)
    {
    }
}
