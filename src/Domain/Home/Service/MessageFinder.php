<?php

declare(strict_types=1);

namespace App\Domain\Home\Service;

use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use App\Domain\Home\Data\Message;
use App\Domain\Home\Repository\MessageFinderRepository;

/**
 * Message Finder service.
 */
final class MessageFinder
{
    /**
     * @Injection
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @Injection
     * @var MessageFinderRepository
     */
    private MessageFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param LoggerFactory $logger The logger factory
     * @param MessageFinderRepository $repository Repository where a message can be found.
     */
    public function __construct(LoggerFactory $logger, MessageFinderRepository $repository)
    {
        $this->logger = $logger
            ->addFileHandler('home-action.log')
            ->createLogger();

        $this->repository = $repository;
    }

    /**
     * Find message.
     *
     * @return Message
     */
    public function findById(int $id): ?Message
    {
        $message = $this->repository->findById($id);

        if ($message !== null) {
            $this->logger->info(sprintf('message output: %s', $message));

            return new Message($id, $message);
        }

        $this->logger->warning('warning output: message is null');

        return null;
    }
}
