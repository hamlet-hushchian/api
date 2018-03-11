<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="books", indexes={@ORM\Index(name="IDX_4A1B2A92F675F31B", columns={"author_id"})})
 * @ORM\Entity(repositoryClass="\Api\Repository\BooksRepository")
 */
class Books
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var \Api\Entity\Authors
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Authors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $author;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Books
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param \Api\Entity\Authors $author
     *
     * @return Books
     */
    public function setAuthor(\Api\Entity\Authors $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Api\Entity\Authors
     */
    public function getAuthor()
    {
        return $this->author;
    }
}

