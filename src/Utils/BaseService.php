<?php

namespace App\Utils;


use App\Interfaces\IRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class BaseService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var LoggerExtended
     */
    protected $logger;

    protected $repository;

    /**
     * BaseService constructor.
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = new LoggerExtended($logger);
    }

    /**
     * @return LoggerExtended
     */
    public function getLogger(): LoggerExtended
    {
        return $this->logger;
    }

    protected function initRepositoryWithLoggerAndEM(){
        if ($this -> repository instanceof IRepository){
            $this -> repository -> setLogger($this -> logger);
            $this -> repository -> setEntityManager($this -> entityManager);
        }
    }

    /**
     * @param $data
     * @param $msg
     * @param bool $toLog
     * @param array $addToArray
     * @return MessageResponseOK
     */
    public function responseOK($data, $msg, $toLog = false, $addToArray = array()){
        $response = new MessageResponseOK();
        $response -> init($data,$msg,$addToArray);
        $response -> toLog($toLog,$this -> logger);
        return $response;
    }

    /**
     * @param $msg
     * @param $code
     * @param bool $toLog
     * @return MessageResponseERROR
     */
    public function responseERROR($msg,$code,$toLog = true){
        $response = new MessageResponseERROR();
        $response -> init(array(),$msg,$code);
        $response -> toLog($toLog,$this -> logger);
        return $response;
    }
}