<?php

/**
 * Description of ILibrary
 *
 * @author nikolay
 */
interface ILibrary 
{
    /**
     * Gets the count of all the books currently present in the library.
     * @return integer
     */
    public function getBooksCount();
    
    /**
     * Gets the count of the different books in the library.
     * @return integer
     */
    public function getDistinctBooksCount();
    
    /**
     * Returns the library instance's unique identifier.
     *
     * @return integer
     */
    public function getId();
    
    /** 
     * Extracts the library's name(specified on construction).
     *
     * @return type 
     */
    public function getName();
    
    /**
     * Checks wether the library has the book in the listings
     * 
     * @param Book $book 
     * @return boolean Truw when the book exists.
     */
    public function hasBook(Book $book);
    
    /**
     * Adds a book to the library
     * 
     * @param Book $book
     * @param type $quantity Books to add. Defaults to 1
     */
    public function addBook(Book $book, $quantity=1);
    
    /**
     * Manages the lending of a book with the help of a ticket.
     * 
     * @param Book $book Book Object to lend.
     * @return LibraryTicket Object, representing the lend book.
     */
    public function lendBook($book);
    
    /**
     * Manages retirning of a book based on a ticket object.
     * Changes the ticket's flab returned to true.
     * 
     * @param LibraryTicket $ticket 
     */
    public function returnBook(&$ticket);

    /**
     * Checks wether the book has qyantity left.
     *
     * @param Book $book
     * @return boolean True when the book is present.
     */
    public function hasQuantityFor($book);
}

