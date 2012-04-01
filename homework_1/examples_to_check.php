<?PHP

error_reporting(E_ALL);

require_once('functions.php');

check('null + true');
check('"23.4" + false');
check('$a = 12; $a = "4" . "5"; $a += 2; echo $a;', true);
check('function change_value( $value ) { $value = 12; } $v = 15; change_value( $v ); echo $v;', true);
check('$x = 203; function change_x() { $x = 200; } change_x(); echo $x;', true);
check('$apple = "green"; $strawbery = "red"; $fruit = "strawbery"; echo $$fruit;', true);
