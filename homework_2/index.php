<?PHP

function __autoload($name)
{
    require_once "classes/$name.php";
}
$t = Timer::instance();
$t->newTimePoint('Begin of requuest');

VehicleFactory::create(VehicleFactory::TYPE_CAR)->move();
echo '<br />';

$t->newTimePoint('After "Car" creation');

VehicleFactory::create(VehicleFactory::TYPE_PLANE)->move();
echo '<br />';

$t->newTimePoint('After "Plane" creation');

$bookAdapter = new BookAdapter(new Book('Nikolay D.', 'It woluld be nice to have my own book :]'));
echo "{$bookAdapter->getAuthorAndTitle()}<br />";

$t->newTimePoint('Prepare library.');
$booksDb = array(
    new Book('A 1', 'T 1'), 1,
    new Book('A 1', 'T 2'), 2,
    new Book('A 2', 'T 1'), 3,
    new Book('A 3', 'T 1'), 4,
    new Book('A 3', 'T 2'), 5,
);

$library = new Library('FMI Library');

for($i=0; $i<count($booksDb); $i+=2)
    $library->addBook($booksDb[$i], $booksDb[$i+1]);

echo "Library content: total => {$library->getBooksCount()}, distinct => {$library->getDistinctBooksCount()}<br />";

$book = $booksDb[0];
$t->newTimePoint('Library - prepared, testing proxy implementation.');
echo 'Proxy test...<br />';
$proxy = new LibraryProxy($library);
if($proxy->hasQuantityFor($book));
    echo "$book is in the library.<br />";
    
$ticket = $proxy->lendBook($book);

if(!$proxy->hasQuantityFor($book));
    echo "$book is not in the library.<br />";
    
echo "Proxy library content: total => {$proxy->booksCount}, distinct => {$proxy->distinctBooksCount}<br />";

if(!$ticket->isReturned)
    echo "The book {$ticket->book} is not returned<br />";
    
$proxy->returnBook($ticket);

if($ticket->isReturned)
    echo "The book {$ticket->book} is returned<br />";
    
if($proxy->hasQuantityFor($book));
    echo "$book is in the library.<br />";
    
echo "Proxy library content: total => {$proxy->booksCount}, distinct => {$proxy->distinctBooksCount}<br />";

$t->newTimePoint('Finished proxy testing.');
$statisticsData = $proxy->statistics;

$t->printTimes();
