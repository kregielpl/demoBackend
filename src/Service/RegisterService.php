<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\BaseService;
use App\Utils\ExceptionMessage;
use App\Utils\MessageResponse;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class RegisterService extends BaseService
{

    /** @var UserRepository $repository */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        parent::__construct($entityManager, $logger);
        $this->repository = $entityManager->getRepository(User::class);
        $this->initRepositoryWithLoggerAndEM();
    }

    /**
     * @param $params
     * @param $encoder
     * @return MessageResponse
     */
    public function addUser($params, $encoder): MessageResponse
    {
        try {
            $data = $this->repository->addUser($params, $encoder);

            return $this->responseOK($data, "Rejestracja", "addUser");
        } catch (ExceptionMessage $e) {
            $this->logger->error("addUser: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "addUser");
        } catch (DBALException $e) {
            $this->logger->error("addUser: " . $e->getMessage());

            return $this->responseERROR($e->getMessage(), $e->getCode(), "addUser");
        }
    }
}