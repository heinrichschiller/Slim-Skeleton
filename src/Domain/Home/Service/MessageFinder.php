<?php

declare(strict_types=1);

namespace App\Domain\Home\Service;

use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;
use App\Domain\Home\Message;
use App\Domain\Home\Repository\MessageFinderRepository;

/**
 * Message Finder service.
 */
final class MessageFinder
{
    /**
     * @Injection
     * @var LoggerInterface;
     */
    private LoggerInterface $logger;

    /**
     * @Injection
     * @var MessageFinderRepository
     */
    private MessageFinderRepository $repository;

    public function __construct(LoggerFactory $logger, MessageFinderRepository $repository)
    {
        $this->logger = $logger
            ->addFileHandler('hello_world.log')
            ->createLogger();
        
        $this->repository = $repository;
    }

    public function findMessage(): Message
    {
        try {
            $message = $this->repository->findMessage();

            $this->logger->info(sprintf('message output: %s', $message[0]));

            return new Message($message[0]);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
    }
}
