<?php

namespace App\Service;

use App\Entity\Message;
use App\Entity\User;
use App\Repository\MessageRepository;
use App\Utils\BaseService;
use App\Utils\ExceptionMessage;
use App\Utils\MessageResponse;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class MessageService extends BaseService
{

    /** @var MessageRepository $repository */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        parent::__construct($entityManager, $logger);
        $this->repository = $entityManager->getRepository(Message::class);
        $this->initRepositoryWithLoggerAndEM();
    }

    /**
     * @param $params
     * @param User $user
     * @return MessageResponse
     */
    public function addUserMessage($params, User $user): MessageResponse
    {
        try {
            $data = $this->repository->addMessage($params, $user);

            return $this->responseOK($data, "Wiadomości", "addUserMessage");
        } catch (ExceptionMessage $e) {
            $this->logger->error("addUserMessage: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "addUserMessage");
        } catch (DBALException $e) {
            $this->logger->error("addUserMessage: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "addUserMessage");
        }
    }

    /**
     * @param $params
     * @param User $user
     * @return MessageResponse
     */
    public function getAllMessage(): MessageResponse
    {
        try {
            $data = $this->repository->getAllMessage();

            return $this->responseOK($data, "Wiadomości", "getAllMessage");
        } catch (ExceptionMessage $e) {
            $this->logger->error("getAllMessage: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "getAllMessage");
        } catch (DBALException $e) {
            $this->logger->error("getAllMessage: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "getAllMessage");
        }
    }
}