<?PHP
error_reporting(E_ALL);

require_once 'functions.php';

$numbers = range(20, 1000, 37);

find_3_prime($numbers);
check_exists($numbers);

function find_3_prime($numbers) 
{
    $primesCount = 0;
    foreach($numbers as $number)
    {
        if( is_prime($number) )
            $primesCount++;
        
        if($primesCount == 3)
        {
            echo "$number<br />";
            break;
        }
    }
}

function check_exists($numbers)
{
    $toCeck = array(146, 284, 871,);
    foreach($toCeck as $number)
    {
        $not = in_array($number, $numbers) ? '' : ' does not';
        echo "The number $number$not exists in the array.<br />";
    }
}

