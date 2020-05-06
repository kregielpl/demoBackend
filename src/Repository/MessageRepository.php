<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function addMessage($data, User $user)
    {
        $em = $this->getEntityManager();

        $m = new Message();
        $m->setCreated(new \DateTime(date('Y-m-d H:i:s')));
        $m->setText($data['message']);
        $m->setUser($user);

        $em->persist($m);
        $em->flush();

        return array('state' => 'OK', 'msg' => 'Pomyślnie zapisano wiadomość', 'data' => []);
    }

    public function getAllMessage()
    {
        return $this->createQueryBuilder('m')
            ->select('m.id, m.text, m.created, u.username')
            ->join('m.user', 'u')
            ->orderBy('m.created', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }
}
