<?php
/**
 * Description of LibraryBook
 *
 * @property integer $quantity
 * @author nikolay
 */
class LibraryBook extends Book
{
    private $_quantity;
    private $_index;
    
    /**
     * Generates an index for this book in the library.
     * 
     * @return string The books index (hash);
     */
    public function getIndex()
    {
        if($this->_index === null)
            $this->_index = md5($this->__toString());
        
        return $this->_index;
    }
    
    public function __construct($author, $title, $quantity) 
    {
        parent::__construct($author, $title);
        $this->quantity = $quantity;
    }
    
    public function getQuantity()
    {
        return $this->_quantity;
    }
    
    public function setQuantity($quantity)
    {
        return $this->_quantity = $quantity;
    }
    
    public function changeQuantityWith($count) 
    {
        return $this->setQuantity($this->getQuantity() + $count);
    }
    
    /**
     * Creates new instance based on Book object.
     *
     * @param Book $book 
     * @param integer $quantity
     * @return LibraryBook
     */
    public static function createFromBook(Book $book, $quantity=1)
    {
        return new self($book->author, $book->title, $quantity);
    }
}
