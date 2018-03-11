<?php

namespace Api\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Api\Entity\Books;

class BooksRepository extends EntityRepository
{
    public function getAllToArray($offset,$limit)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('b','a')
            ->from(Books::class, 'b')
            ->leftJoin('b.author', 'a');

        if ($offset > 0)
            $queryBuilder->setFirstResult($offset);

        if ($limit > 0)
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function getByAuthorToArray($author_id,$offset,$limit)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('b','a')
            ->from(Books::class, 'b')
            ->leftJoin('b.author', 'a')
            ->where('a.id = :author_id')
            ->setParameter('author_id',$author_id);

        if ($offset > 0)
            $queryBuilder->setFirstResult($offset);

        if ($limit > 0)
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function getTotalCount()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('COUNT(b.id)')
            ->from(Books::class, 'b');

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }
}