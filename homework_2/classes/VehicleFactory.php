<?php

/**
 * Description of VehicleFactory
 *
 * @author nikolay
 */
class VehicleFactory 
{
    const TYPE_CAR = 'Car';
    const TYPE_PLANE = 'Plane';
    
    /**
     * Managed the creation of IVehicle objects.
     *
     * @param string $type
     * @return IVehicle
     */
    public static function create($type)
    {
        switch($type)
        {
            case self::TYPE_CAR:
                $instance = new Car;
                break;
            case self::TYPE_PLANE:
                $instance = new Plane;
                break;
            default:
                throw new Exception('Unknow type!');
        }
        return $instance;
    }
}

?>
