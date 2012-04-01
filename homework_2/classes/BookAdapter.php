<?php

/**
 * Book adapter, changing the book's interface.
 *
 * @author nikolay
 */
class BookAdapter 
{
    /** @var Book */
    private $book;
    
    /**
     * @param Book $book Book instance to adapt.
     */
    public function __construct(Book $book) 
    {
        $this->book = $book;
    }
    
    /**
     * Extracts book title and author information.
     *
     * @return string
     */
    public function getAuthorAndTitle() 
    {
        return "`{$this->book->title}` by {$this->book->author}";
    }
}

