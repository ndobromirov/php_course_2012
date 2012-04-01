<?PHP
function is_prime($n)
{
	$end = $n / 2;
	for($i=2; $i<$end; $i++)
		if($n % $i == 0)
			return false;
	
	return true;
}

function check($expression, $justEval=false)
{
    if($justEval)
    {
        eval($expression);
    }
    else
    {
        echo "$expression => ";
        eval('var_dump('.$expression.');');
    }
    echo '<br />';
}
