<?php
/**
 * Sample book class
 *
 * @property string $author
 * @property string $title
 * @author nikolay
 */
class Book 
{
    private $author, $title;
    
    public function __construct($author, $title) 
    {
        $this->author = $author;
        $this->title = $title;
    }
    
    public function __get($name) 
    {
        return $this->$name;
    }
    
    public function __set($name, $value) 
    {
        return $this->$name = $value;
    }
}

