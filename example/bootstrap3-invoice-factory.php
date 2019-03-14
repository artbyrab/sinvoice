<?php

// Uncomment the below if you need to see errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// manually include the autoload file so we can use the library here
require ('../vendor/autoload.php');

use artbyrab\sinvoice\InvoiceFactory;
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Item;
use artbyrab\sinvoice\Entity;
use artbyrab\sinvoice\FlatDiscount;
use artbyrab\sinvoice\PercentageDiscount;

$invoiceFactory = (new InvoiceFactory())
    ->addSupplier(
        (new Entity())
        ->setName('Emperor Nero')
        ->setAddress('Via Cavour, Rome, Italy')
        ->setPhone('01234 567891')
        ->setEmail('nero@rome.com')
        ->setReference('nero123')
    )
    ->setTaxPercentage(20)
    ->setIssuedDate('Today')
    ->setDueDate('+21 days');

$invoice = $invoiceFactory->buildInvoice();

$invoice->setNumber('2')
    ->setReference('Ref-2')
    ->addCustomer(
        (new Entity())
        ->setName('Ceasar')
        ->setAddress('1 High Street, Rome, Italy')
        ->setPhone('01245 678910')
        ->setEmail('ceasar@rome.com')
        ->setReference('a145')
    )
    ->addDiscount(
        (new PercentageDiscount())
        ->setFigure(50)
    )
    ->addItem(
        (new Item)
        ->setPrice(2.99)
        ->setQuantity(10)
        ->setName('Baseball Sticker Pack')
        ->addDiscount(
            (new FlatDiscount())
                ->setFigure(10)
                ->setDescription('Recurring Customer')
        )
    )
    ->addItem(
        (new Item())
        ->setName('Baseball sticker book')
        ->setPrice(20.00)
        ->setQuantity(3)
    );
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Sinvoice - Bootstrap 3 Template</title>
  <meta name="description" content="Sinvoice - Bootstrap 3 Template">
  <meta name="author" content="artbyrab">

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
        <?php include "_nav.php"; ?> 
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12"> 
                <h2>Bootstrap 3 Invoice Factory Example</h2>
            </div><!--/.col-->
        </div><!--/.row-->
    </div><!--/.container--> 
    <?php include "_bootstrap-template.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> 
                <hr>
                <h2>Code</h2>
<pre>
use artbyrab\sinvoice\InvoiceFactory;
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Item;
use artbyrab\sinvoice\Entity;
use artbyrab\sinvoice\FlatDiscount;
use artbyrab\sinvoice\PercentageDiscount;

$invoiceFactory = (new InvoiceFactory())
    ->addSupplier(
        (new Entity())
        ->setName('Emperor Nero')
        ->setAddress('Via Cavour, Rome, Italy')
        ->setPhone('01234 567891')
        ->setEmail('nero@rome.com')
        ->setReference('nero123')
    )
    ->setTaxPercentage(20)
    ->setIssuedDate('Today')
    ->setDueDate('+21 days');

$invoice = $invoiceFactory->buildInvoice();

$invoice->setNumber('123')
    ->setReference('exampleB')
    ->addCustomer(
        (new Entity())
        ->setName('Ceasar')
        ->setAddress('1 High Street, Rome, Italy')
        ->setPhone('01245 678910')
        ->setEmail('ceasar@rome.com')
        ->setReference('a145')
    )
    ->addDiscount(
        (new PercentageDiscount())
        ->setFigure(50)
    )
    ->addItem(
        (new Item)
        ->setPrice(2.99)
        ->setQuantity(10)
        ->setName('Baseball Sticker Pack')
        ->addDiscount(
            (new FlatDiscount())
                ->setFigure(10)
                ->setDescription('Recurring Customer')
        )
    )
    ->addItem(
        (new Item())
        ->setName('Baseball sticker book')
        ->setPrice(20.00)
        ->setQuantity(3)
    );
</pre>     
            </div><!--/.col-->
        </div><!--/.row-->
    </div><!--/.container--> 
    <script src="js/scripts.js"></script>
</body>
</html>