
<?php

// Uncomment the below if you need to see errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../vendor/autoload.php');

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;

$invoice = new Invoice();

$item = (new Item())
    ->setName('Gladius Sword')
    ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
    ->setPrice(120.00)
    ->setQuantity(4);

$invoice->addItem($item);

echo "<pre>";
print_r($invoice->getTotals());
echo "</pre>";

?>