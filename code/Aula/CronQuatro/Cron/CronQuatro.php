<?php
namespace Aula\CronQuatro\Cron;

use Psr\Log\LoggerInterface;

class CronQuatro {
    protected  $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Cron Quatro rodando');
    }
}
