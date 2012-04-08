<?php

/**
 * Description of LibraryTicket
 *
 * @property-read integer $lendTime
 * @property-read boolean $isReturned
 * @property-read Book $book
 * @property-read Library $library
 * @author nikolay
 */
class LibraryTicket extends Component
{
    /** @var Library */
    private $_library;
    
    /** @var Book */
    private $_borrowedBook;
    
    private $_returned = false;
    
    /**
     * Timestamp of ticket creation.
     *
     * @var integer
     */
    private $_lendTime;
    
    /**
     * Constructor for the class ticet
     *
     * @param Library $library
     * @param Book $book 
     */
    public function __construct($library, $book) 
    {
        $this->setLibrary($library);
        $this->setBook($book);
        if($this->_lendTime === null)
            $this->_lendTime = time(); // time of creation.
    }
    
    public function getIsReturned() 
    {
        return $this->_returned;
    }
    
    public function setAsReturned() 
    {
        $this->_returned = true;
    }
    
    public function getLendTime()
    {
        return $this->_lendTime;
    }
    
    /**
     * Gets the library given the ticket.
     *
     * @return Library
     */
    public function getLibrary()
    {
        return $this->_library;
    }
    
    /**
     * Sets the library associated with the ticket.
     *
     * @param Library $library 
     * @return Library
     */
    private function setLibrary(Library $library)
    {
        return $this->_library = $library;
    }
    
    public function getBook() 
    {
        return $this->_borrowedBook;
    }
    
    private function setBook($book)
    {
        return $this->_borrowedBook = $book;
    }
}

?>
