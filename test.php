<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Entity;
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Sinvoice</title>
    <meta name="description" content="Sinvoice - Sin Free Invoicing">
    <meta name="author" content="RABUS">

    <link rel="stylesheet" href="css/styles.css?v=1.0">

    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>

<body>


<div class="container">
    <div class="row">
        <div class="well">
            <p>So to create our invoice we first instantiate a new invoice</p>
            <p><code>$invoice = new Invoice();</code></p>

            //$supplier = new Entity();
            $invoice->addSupplier(new Entity());
            $invoice->supplier->setName('Box supplier');
            $invoice->supplier->setAddress('1 High street, box land.');

            $customer = new Entity();
            $customer->setName('Mario Customer');
            $customer->setPhone('01234 567891');
            $invoice->addCustomer($customer);

            $itemA = new Item('Ping Pong Bat', 19.99, 1);
            $invoice->addItem($itemA);

            $itemB = new Item();
            $itemB->setPrice(5);
            $itemB->setName('Ping pong balls');
            $itemB->setQuantity(5);

            $invoice->addItem($itemB);
        </div> 
    </div>
</div>


   
<?php 
$invoice = new Invoice();

//$supplier = new Entity();
$invoice->addSupplier(new Entity());
$invoice->supplier->setName('Box supplier');
$invoice->supplier->setAddress('1 High street, box land.');

$customer = new Entity();
$customer->setName('Mario Customer');
$customer->setPhone('01234 567891');
$invoice->addCustomer($customer);

$itemA = new Item('Ping Pong Bat', 19.99, 1);
$invoice->addItem($itemA);

$itemB = new Item();
$itemB->setPrice(5);
$itemB->setName('Ping pong balls');
$itemB->setQuantity(5);

$invoice->addItem($itemB);
echo "<pre>";
print_r($invoice);
echo "</pre>";

$invoice->calculateTotals();
echo "<pre>";
print_r($invoice->getTotals());
echo "</pre>";



?>
    <script src="js/scripts.js"></script>
</body>
</html>