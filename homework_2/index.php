<?PHP

function __autoload($name)
{
    require_once "classes/$name.php";
}

Timer::instance()->newTimePoint('Begin of requuest');

VehicleFactory::create(VehicleFactory::TYPE_CAR)->move();
echo '<br />';

Timer::instance()->newTimePoint('After "Car" creation');

VehicleFactory::create(VehicleFactory::TYPE_PLANE)->move();
echo '<br />';

Timer::instance()->newTimePoint('After "Plane" creation');

$bookAdapter = new BookAdapter(new Book('Nikolay D.', 'It woluld be nice to have my own book :]'));
echo "{$bookAdapter->getAuthorAndTitle()}<br />";

Timer::instance()->newTimePoint('After adaptor\'s demo.');

Timer::instance()->printTimes();