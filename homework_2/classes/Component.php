<?php

/**
 * Description of Component
 *
 * @author nikolay
 */
class Component 
{
    public function __get($name) 
    {
        $getter = 'get'.$name;
        if(method_exists($this, $getter))
            return $this->$getter();
        
        throw new Exception("Property `$name` does not exist in ".__CLASS__);
    }
    
    public function __set($name, $value) 
    {
        $setter = 'set'.$name;
        if(method_exists($this, $setter))
            return $this->$setter($value);
        
        if(method_exists($this, 'get'.$name))
            throw new Exception("Property `$name` in ".__CLASS__.' is read only!');
        else
            throw new Exception("Property `$name` does not exist in ".__CLASS__);
    }
}
