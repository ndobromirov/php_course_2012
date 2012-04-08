<?php
/**
 * Description of Library
 * 
 * @property integer $booksCount
 * @property integer $distinctBooksCount
 * @property-read string $name
 * @author nikolay
 */
class Library extends Component implements ILibrary
{
    private static $instanceCounter = 0;
    /** @var LibraryBook */
    private $books = array();
    
    private $_id;
    
    private $_name;
    
    public function __construct($name=null) 
    {
        self::$instanceCounter++;
        
        $this->_id = self::$instanceCounter;
        
        if($name === null)
        {
            $class = __CLASS__;
            $name = "$class-$this->id";
        }
        
        $this->_name = $name;
    }
    
    /**
     * Returns the library instance's unique identifier.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /** 
     * Extracts the library's name(specified on construction).
     *
     * @return type 
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * @param Library $library
     * @return boolean
     */
    private function equals(Library $library)
    {
        return $this->id === $library->id;
    }
    
    /** @var integer */
    private $_booksCount = 0;
    
    
    public function getBooksCount() 
    { 
        return $this->_booksCount;
    }
    
    private function setBooksCount($newCount) 
    { 
        return $this->_booksCount = $newCount; 
    }
    
    /** @var integer */
    private $_distinctBooksCount = 0;
    
    /**
     * Gets the count of the different books in the library.
     * @return integer
     */
    public function getDistinctBooksCount()
    {
        return $this->_distinctBooksCount;
    }
    
    private function setDistinctBooksCount($count)
    {
        return $this->_distinctBooksCount = $count;
    }
    
    /**
     * Adds a book to the library
     * 
     * @param Book $book
     * @param type $quantity Books to add. Defaults to 1
     */
    public function addBook(Book $book, $quantity = 1)
    {
        $libraryBook = LibraryBook::createFromBook($book, $quantity);
        
        if($this->hasBook($libraryBook))
        {
            $this->books[$libraryBook->index]->quantity += $quantity;
        }
        else
        {
            $this->books[$libraryBook->index] = $libraryBook;
            $this->setDistinctBooksCount($this->distinctBooksCount + 1);
        }
        $this->setBooksCount($this->booksCount + $quantity);
    }
    
    /**
     * Manages the lending of a book with the help of a ticket.
     * 
     * @param Book $book Book Object to lend.
     * @return LibraryTicket Object, representing the lend book.
     */
    public function lendBook($book)
    {    
        if( ! $this->hasQuantityFor($book) )
            throw new Exception("$book - quantities are exhausted");
        
        // Remove from Library
        $this->books[$this->libraryBook($book)->index]->changeQuantityWith(-1);
        $this->setBooksCount($this->booksCount - 1);
        
        $ticket = new LibraryTicket($this, $book);
        return $ticket;
    }
    
    /**
     * Manages retirning of a book based on a ticket object.
     * Changes the ticket's flab returned to true.
     * 
     * @param LibraryTicket $ticket 
     */
    public function returnBook(&$ticket)
    {
        if(!$this->equals($ticket->library))
            throw new Exception('Can not return books from another library!');
        
        
        if(!$ticket->isReturned)
        {
            $this->addBook($ticket->book);
            $ticket->setAsReturned();
        }
    }
    
    /**
     * Checks wether the library has the book in the listings
     * 
     * @param Book $book 
     * @return boolean Truw when the book exists.
     */
    public function hasBook(Book $book)
    {
        return array_key_exists($this->libraryBook($book)->index, $this->books);
    }
    
    /**
     * Checks wether the book has qyantity left.
     *
     * @param Book $book
     * @return boolean True when the book is present.
     */
    public function hasQuantityFor($book)
    {
        $book = $this->libraryBook($book);
        if( !$this->hasBook($book))
            throw new Exception("The book $book is not in the library");
        
        if( ! ( $this->books[$book->index]->quantity > 0) )
            return false;
        
        return true;
    }
    
    /**
     * Creates a LibraryBook out of a book instance, if needed.
     *
     * @param Book $book Or descendant
     * @return LibraryBook
     */
    private function libraryBook($book)
    {
        if(! ($book instanceof LibraryBook))
            $book = LibraryBook::createFromBook($book);
        
        return $book;
    }
}

