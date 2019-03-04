<?php

// Uncomment the below if you need to see errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// manually include the autoload file so we can use the library here
require ('../vendor/autoload.php');

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\FlatDiscount;
use Rabus\Sinvoice\PercentageDiscount;

$invoice = (new Invoice())
    ->setNumber('1')
    ->setReference('Ref-1')
    ->setCreatedDate('today')
    ->setIssuedDate('today')
    ->setDueDate('+21 days')
    ->addSupplier(
        (new Entity())
        ->setName('Rome Suppliers')
        ->setAddress('1 Main Street, Industrial District, Rome, Italy')
        ->setPhone('01234 567899')
        ->setEmail('rsuppliers@rome.com')
        ->setReference('rsa')
    )
    ->addCustomer(
        (new Entity())
        ->setName('Ceasar')
        ->setAddress('1 High Street, Rome, Italy')
        ->setPhone('01245 678910')
        ->setEmail('ceasar@rome.com')
        ->setReference('a145')
    )
    ->setTaxPercentage(10)
    ->addDiscount(
        (new PercentageDiscount())
        ->setFigure(100)
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
        <?php include "_nav.php"; ?> 
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12"> 
                <h2>Bootstrap 3 Invoice Example</h2>
            </div><!--/.col-->
        </div><!--/.row-->
    </div><!--/.container--> 
    <?php include "_bootstrap-template.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12"> 
                <h2>Code</h2>
<pre>
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\FlatDiscount;
use Rabus\Sinvoice\PercentageDiscount;

$invoice = (new Invoice())
    ->setNumber('1')
    ->setReference('Ref-1')
    ->setCreatedDate('today')
    ->setIssuedDate('today')
    ->setDueDate('+21 days')
    ->addSupplier(
        (new Entity())
        ->setName('Rome Suppliers')
        ->setAddress('1 Main Street, Industrial District, Rome, Italy')
        ->setPhone('01234 567899')
        ->setEmail('rsuppliers@rome.com')
        ->setReference('rsa')
    )
    ->addCustomer(
        (new Entity())
        ->setName('Ceasar')
        ->setAddress('1 High Street, Rome, Italy')
        ->setPhone('01245 678910')
        ->setEmail('ceasar@rome.com')
        ->setReference('a145')
    )
    
    ->setTaxPercentage(10)
    ->addDiscount(
        (new PercentageDiscount())
        ->setFigure(100)
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