<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

Class ApiController extends AbstractRestfulController
{

    public function __construct($apiManager)
    {
        $this->apiManager = $apiManager;
    }

    public function booksAction()
    {
        $limit = $this->params()->fromQuery('limit',0);
        $offset = $this->params()->fromQuery('offset',0);
        $rows = $this->apiManager->getBooksTotalCount();
        if($offset >= $rows)
            $offset = 0;

        $books = $this->apiManager->getBooks($offset,$limit);

        return new JsonModel([
            'status' => 'OK',
            'message' => 'OK',
            'data' => [
                'books' => $books,
                'limit' => $limit,
                'offset' => $this->params()->fromQuery('offset',0),
                'rows' => $rows
            ]
        ]);
    }

    public function authorsAction()
    {
        $id = $this->params()->fromRoute('id');
        $data = $this->params()->fromRoute('data');
        $limit = $this->params()->fromQuery('limit',0);
        $offset = $this->params()->fromQuery('offset',0);
        $rows = $this->apiManager->getAuthorsTotalCount();
        if($offset >= $rows)
            $offset = 0;
        if($id)
        {
            if($data)
            {
                $methodName = 'getAuthor' . ucfirst($data);
                $authorData = $this->apiManager->$methodName($id,$offset,$limit);

                if($authorData)
                {
                    return new JsonModel([
                        'status' => 'OK',
                        'message' => 'OK',
                        'data' => [
                            $data => $authorData,
                            'limit' => $limit,
                            'offset' => $this->params()->fromQuery('offset',0),
                            'rows' => $rows
                        ]
                    ]);
                }
                else
                {
                    throw new \Api\Exception\NotFound('Author not exists');
                }

            }
            else
            {
                $this->getResponse()->setStatusCode(400);
            }
        }
        else
        {
            $authors = $this->apiManager->getAuthors($offset,$limit);
            return new JsonModel([
                'status' => 'OK',
                'message' => 'OK',
                'data' => [
                    'authors' => $authors,
                    'limit' => $limit,
                    'offset' => $this->params()->fromQuery('offset',0),
                    'rows' => $rows
                ]
            ]);
        }

    }
}