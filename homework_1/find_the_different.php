<?PHP
error_reporting(E_ALL);

/**
 * Returns the only single element in the array
 * ( The array should be with odd count elements and all except one to be       
 * even in count. )
 * 
 * Errors are thrown on empty array => false
 * 
 * 
 * @param Array $numbers Array of integers to search in
 * @return mixed False on error, the different element otherwise.
 */
function find_the_different_in($numbers)
{
    if( empty($numbers) )
        throw new Exception ('Empty array!!!');

    $count = count($numbers);
    if($count % 2 == 0)
        throw new Exception ('Non odd elements count!!!');
    
    $result = $numbers[0];
    $result = 0;
    foreach($numbers as $number)
        $result ^= $number;

    return $result;
}

$numbers = array(1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,0,8,8);

echo find_the_different_in($numbers);