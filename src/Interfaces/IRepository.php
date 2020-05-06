<?php

namespace App\Interfaces;

use App\Utils\LoggerExtended;
use Doctrine\ORM\EntityManagerInterface;

interface IRepository
{
    public function setEntityManager(EntityManagerInterface $entityManager);

    public function setLogger(LoggerExtended $logger);
}