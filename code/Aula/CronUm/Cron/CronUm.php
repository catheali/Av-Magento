<?php
namespace Aula\CronUm\Cron;
use Psr\Log\LoggerInterface;

class CronUm
{
    protected  $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Cron Um rodando');
    }
}
