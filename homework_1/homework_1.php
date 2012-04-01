<?PHP
error_reporting(E_ALL);

require_once 'functions.php';

define('LIMIT_BOTTOM', 0);
define('LIMIT_TOP', 19999);



if(!array_key_exists('number', $_GET) || !preg_match('/^\d{1,'.strlen(LIMIT_TOP).'}$/', $_GET['number']))
	list($messageClass, $message) = array('error', 'The parameter is not a number');
elseif( $_GET['number'] < LIMIT_BOTTOM || LIMIT_TOP < $_GET['number'] )
	list($messageClass, $message) = array('error', 'The parameter is not within the range ['.LIMIT_BOTTOM.','.LIMIT_TOP.']');
elseif(!is_prime($_GET['number']))
	list($messageClass, $message) = array('not-prime', "The number $_GET[number] is NOT prime!");
else
	list($messageClass, $message) = array('prime', "The number $_GET[number] is prime!");

?><!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			.error { color: #FF0000;}
			.not-prime { color: #0000FF;}
			.prime { color: #000000;}
		</style>
	</head>
	<body>
		<span class="<?PHP echo $messageClass; ?>"><?PHP echo $message; ?></span>
	</body>
</html>