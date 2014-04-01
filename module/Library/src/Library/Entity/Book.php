<?php

namespace Library\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book {
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string", length=45, nullable=false)
     */
    protected $title;

     /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $isbn;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $author;

    /**
     * @ORM\ManyToOne(targetEntity="User\Entity\User", inversedBy="borrowedList")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     **/   
    protected $borrower;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }

    public function getBorrower() {
        return $this->borrower;
    }

    public function setBorrower($borrower) {
        $this->borrower = $borrower;
        return $this;
    }
}