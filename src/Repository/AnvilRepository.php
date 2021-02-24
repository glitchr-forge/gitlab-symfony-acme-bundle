<?php

namespace Acme\Bundle\Repository;

use Acme\Bundle\Model\Anvil;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anvil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anvil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anvil[]    findAll()
 * @method Anvil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnvilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anvil::class);
    }

}
