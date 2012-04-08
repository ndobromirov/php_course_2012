<?php
/**
 * Sample book class
 *
 * @property string $author
 * @property string $title
 * @author nikolay
 */
class Book extends Component
{
    private $_author, $_title;
    
    public function __construct($author, $title) 
    {
        $this->author = $author;
        $this->title = $title;
    }
    
    public function getAuthor()
    {
        return $this->_author;
    }
    
    public function setAuthor($author)
    {
        return $this->_author = $author;
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function setTitle($title)
    {
        return $this->_title = $title;
    }
    
    public function __toString() 
    {
        return "'$this->title' by $this->author";
    }
    
    /**
     * Checks wether the book is the same as the givven one.
     *
     * @param Book $book
     * @return boolean True when the books are the same.
     */
    public function equals($book)
    {
        return $this->author == $book->author && $this->title == $book->title;
    }
}

