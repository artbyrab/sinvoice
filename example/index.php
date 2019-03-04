<?php
require ('../vendor/autoload.php');

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Sinvoice</title>
    <meta name="description" content="Sinvoice">
    <meta name="author" content="RABUS">

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
            <div class="col-xs-12">
                <?php include "_nav.php"; ?>
                <h1>Sinvoice Example</h1>
                <p>Learn how to use Sinvoice.</p>
            </div><!--/.col-->
            <div class="col-xs-12">
                <h2>Create an invoice with items and shipping</h2>
                <pre><code>use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\item;

$sinvoice = (new Invoice())
    ->setNumber(1)
    ->setIssuedDate('Today')
    ->setDueDate('+21 Days)
    ->addTaxPercentage(20.00)
    ->addSupplier(
        (new Entity())
        ->setName('Quality Roman Suppliers')
        ->setAddress('1 Ampitheatre Road, Rome')
    )
    ->addCustomer(
        (new Entity())
        ->setName('Julius Ceaser')
        ->setAddress('Todo')
    )
    (new Shipping())
        ->addRecipient(
            (new Entity())
            ->setName('Ceasar')
            ->setAddress('1 High Street, Rome, Italy')
            ->setPhone('01245 678910')
            ->setEmail('ceasar@rome.com')
            ->setReference('a145')
        )
        ->setPrice(10.99)
        ->setDeliveryDate('+7 days')
        ->setHandler('Rome Road Mail')
        ->setReference('8547124')
    )

    )
    ->addItem(
        (new Item())
        ->setName('Gladius Sword')
            ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
            ->setPrice(120.00)
            ->setQuantity(2);
        ->addDiscount(
            (new PercentageDiscount())
            ->setFigure(10)
        )
    )</code></pre>
            <p>Look at the 2 other example pages for more.</p>
        </div><!--/.col-->
    </div><!--/.col-->
</body>
</html>