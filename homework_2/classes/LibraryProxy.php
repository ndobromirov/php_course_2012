<?php
/**
 * Description of LibraryProxy
 *
 * @property-read array $statistics
 * @author nikolay
 */
class LibraryProxy extends Component // implements ILibrary
{
    private $_library;
    private $_statistics = array();
    
    public function __construct($library = null) 
    {
        if($library !== null)
            $this->_library = $library;
    }
    
    /**
     * Extracts the proxy access logs with metor return values.
     *
     * @return array
     */
    public function getStatistics()
    {
        return $this->_statistics;
    }
    
    /**
     * Channel properties to the inner object
     * 
     * @param type $name
     * @return type 
     */
    public function __get($name) 
    {
        try {
            // try to get property of the inner object
            return $this->proxy('getProperty', $name);
        } catch (Exception $e) {
            // check for property in the proxy...
            return parent::__get($name);
        }
    }
    
    /**
     * Channel property setting to the inner object.
     *
     * @param type $name
     * @param type $value
     * @return type 
     */
    public function __set($name, $value) 
    {
        try {
            return $this->proxy('setProperty', $name, $value);
        } catch (Exception $e) {
            return parent::__set($name, $value);
        }
    }
    
    /**
     * Channel method calls to the inner object.
     * 
     * @param type $name
     * @param type $arguments
     * @return type 
     */
    public function __call($name, $arguments) 
    {
        if(!method_exists('ILibrary', $name))
            throw new Exception("Unknown method `$name` in ILibrary interface.");
        
        return $this->proxy('callMethod', $name, $arguments);
    }
    
    /**
     * Gets a property value form the inner object.
     * (CallBack used in {@see proxy} method)
     *
     * @param string $name Property name
     * @return mixed the property value.
     */
    private function getProperty($name)
    {   
        return $this->getLibrary()->$name;
    }
    
    /**
     * Sets a property of the inner library object.
     * (CallBack used in {@see proxy} method)
     * 
     * @param string $name Property's name
     * @param mixed $value
     * @return mixed the new property value
     */
    private function setProperty($name, $value)
    {
        return $this->getLibrary()->$name = $value;
    }
    
    /**
     * Calls a method from the inner objext.
     * (CallBack used in {@see proxy} method)
     * 
     * @param string $name Method's name
     * @param array $args Arguments to pass. Defaults to empty array.
     * @return mixed The method's return value.
     */
    private function callMethod($name, $args = array())
    {
        return call_user_func_array(array($this->getLibrary(), $name), $args);
    }
    
    /**
     * Proxies an action to the inner object
     *
     * @param string $callBack 
     * @param type $name
     * @param type $arguments
     * @return type 
     */
    private function proxy($callBack, $name, $arguments=array() )
    {
        $this->_accumulateStats($name, $arguments);
        $value = call_user_func(array($this, $callBack), $name, $arguments);
        $this->_storeReturnValue($name, $value);
        return $value;
    }
    
    /**
     * Lazy load library object if not constructed with one.
     *
     * @return Library
     */
    private function getLibrary()
    {
        if($this->_library === null)
            $this->_library = new Library();
        
        return $this->_library;
    }
    
    /**
     * Method for accumulate library statistics based on methods executed.
     *
     * @param type $method Method being executed
     * @param type $params Parameters passed to the method.
     * @return LibraryProxy to allow chained calling.
     */
    private function _accumulateStats($method, $params = array())
    {
        if(!array_key_exists($method, $this->_statistics))
            $this->_statistics[$method] = array();
        
        array_unshift($this->_statistics[$method], $params);
        
        return $this;
    }
    
    /**
     * Stores the return value for the given method
     * 
     * @param type $method
     * @param type $value
     */
    private function _storeReturnValue($method, $value) 
    {
        $this->_statistics[$method][0]['return'] = $value;
    }
}
