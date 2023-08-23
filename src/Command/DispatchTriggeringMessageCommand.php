<?php

namespace App\Command;

use App\Message\TriggeringMessage;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\TransportNamesStamp;

#[AsCommand('app:trigger')]
class DispatchTriggeringMessageCommand extends Command
{
    public function __construct(private readonly MessageBusInterface $externalBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->externalBus->dispatch(new TriggeringMessage(), [new TransportNamesStamp(['external'])]);

        (new SymfonyStyle($input, $output))->success('Message dispatched');;

        return 0;
    }
}
