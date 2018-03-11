<?php
namespace Api\Service;

use Api\Entity\Books;
use Api\Entity\Authors;

class ApiManager{

    private $entityManager;

    public function __construct($em)
    {
        $this->entityManager = $em;
    }

    public function getBooks($offset,$limit)
    {
        return $this->entityManager->getRepository(Books::class)->getAllToArray($offset,$limit);
    }

    public function getBooksTotalCount()
    {
        return $this->entityManager->getRepository(Books::class)->getTotalCount();
    }

    public function getAuthorsTotalCount()
    {
        return $this->entityManager->getRepository(Authors::class)->getTotalCount();
    }


    public function getAuthors($offset,$limit)
    {
        return $this->entityManager->getRepository(Authors::class)->getAllToArray($offset,$limit);
    }

    public function getAuthorBooks($author_id,$offset,$limit)
    {
        if($this->entityManager->getRepository(Authors::class)->findOneById($author_id))
            return $this->entityManager->getRepository(Books::class)->getByAuthorToArray($author_id,$offset,$limit);
        else
            return false;
    }
}