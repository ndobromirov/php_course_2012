<?php
/**
 * Basic timer implementation. 
 *
 * @author nikolay
 */
class Timer 
{
    private static $instance;

    private $times = array();
    
    /**
     * Lazy loading of Timer class instance.
     *
     * @return Timer
     */
    public static function instance()
    {
        if(self::$instance === null)
            self::$instance = new self();
        
        return self::$instance;
    }
    
    private function __construct() 
    {
        $this->newTimePoint('start');
    }
    
    private function __clone() 
    {
        trigger_error('Colning of class'.__CLASS__.' is not prohibited!', E_USER_ERROR);
    }
    
    
    private $timePoints = 0;
    
    /**
     *
     * @param string $name - non required
     * @return Timer 
     */
    public function newTimePoint($name = '')
    {
        $this->timePoints++;
        if($name === '')
            $name = "time-point-$this->timePoints";
        
        $this->times[] = array(
            'name' => $name,
            'time' => microtime(true) - $this->times[0]['time'], // Difference from beginning of "time"
        );
        return $this;
    }
    
    /**
     * Prints accumulated times data in a readable way. (I hope :))
     */
    public function printTimes()
    {
        foreach($this->times as $idx => $timePoint)
        {
            if(!$idx) continue;
            $time = round($timePoint['time'], 4);
            echo "$time seconds to {$timePoint['name']}<br />";
        }
    }
    
    public function getTimes()
    {
        return $this->times;
    }
}
