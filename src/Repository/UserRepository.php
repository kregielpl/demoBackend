<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $data
     * @param $encoder
     * @return array|string[]
     */
    public function addUser($data, $encoder)
    {
        $em = $this->getEntityManager();
        $objUser = $em->getRepository(User::class)->findOneBy(array('username' => $data['username']));

        if ($objUser) {
            return ['state' => 'ERROR', 'msg' => 'Użytkownik o loginie `' . $data['username'] . '` już istnieje'];
        } else {
            $objUser = $em->getRepository(User::class)->findOneBy(array('email' => $data['email']));

            if ($objUser) {
                return ['state' => 'ERROR', 'msg' => 'Użytkownik o adresie email `' . $data['email'] . '` już istnieje'];
            }
        }

        $u = new User();
        $u->setUsername($data['username']);
        $u->setEmail($data['email']);
        $encoded = $encoder->encodePassword($u, $data['password']);
        $u->setPassword($encoded);
        $u->setEnabled(true);
        $u->setRoles(array(User::ROLE_DEFAULT));

        $em->persist($u);
        $em->flush();

        return array('state' => 'OK', 'msg' => 'Dodano nowego Użytkownika', 'data' => []);
    }
}
