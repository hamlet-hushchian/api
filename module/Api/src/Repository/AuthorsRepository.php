<?php

namespace Api\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Api\Entity\Authors;

class AuthorsRepository extends EntityRepository
{

    public function getAllToArray($offset,$limit)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Authors::class, 'a');

        if ($offset > 0)
            $queryBuilder->setFirstResult($offset);

        if ($limit > 0)
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function getTotalCount()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('COUNT(a.id)')
            ->from(Authors::class, 'a');

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }
}