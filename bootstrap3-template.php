<?php

// Uncomment the below if you need to see errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;

// lets create our new invoice
$invoice = new Invoice();
$invoice->setNumber("54678");
$invoice->setSupplier("Grant's Baseball Store, 1 High Street, London, England");
$invoice->setCustomer("Frank Castle, 10 Main Street, Exeter, England");
$invoice->setCustomerShippingAddress($invoice->getCustomer());

// add an item
$itemA = new Item();
$itemA->setPrice(2);
$itemA->setQuantity(10);
$itemA->setName('Baseball Sticker Pack');
$invoice->addItem($itemA);

// add another item
$itemB = new Item();
$itemB->setPrice(20.0);
$itemB->setQuantity(2);
$itemB->setName('Baseball Sticker Book');
$invoice->addItem($itemB);

// add another item
$itemC = new Item();
$itemC->setName('Punisher Tshirt');
$itemC->setPrice(19.99);
$itemC->setQuantity(1);
$invoice->addItem($itemC);

// calculate the totals
$invoice->calculateTotals();
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
        <div class="well">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Invoice #<?php echo $invoice->getNumber(); ?></h2>
                </div><!--/.col-->
                <div class="col-lg-6">
                </div><!--/.col-->
                <div class="col-lg-12">
                    <hr>
                </div><!--/.col-->
                <div class="col-lg-12">
                    <h3>Invoice From:</h3>
                    <p><?php echo $invoice->getSupplier(); ?></p>
                </div><!--/.col-->
                <div class="col-lg-6">
                    <h3>Invoice Details:</h3>
                    Invoice Issued date: <?php echo $invoice->getCreatedDate(); ?><br>
                    Invoice Due date: <?php echo $invoice->getDueDate(); ?><br>
                </div><!--/.col-->
                <div class="col-lg-12">
                    <hr>
                    <h3>Bill To:</h3>
                    <p><?php echo $invoice->getCustomer(); ?><p><br>
                    <strong>Customer Shipping Address</strong>
                    <?php echo $invoice->getCustomerShippingAddress(); ?><br>
                </div><!--/.col-->
                <div class="col-lg-12">
                    <br>
                    <hr>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Price Total</th>
                            <th>Discount Percentage</th>
                            <th>Discount Total</th>
                            <th>Net Total</th>
                        </tr>
                    <?php foreach ($invoice->getItems() as $item) { ?>
                        <tr>
                            <td><?php echo $item->getName();?></td>
                            <td><?php echo $item->getPrice();?></td>
                            <td><?php echo $item->getQuantity();?></td>
                            <td><?php echo $item->getPriceTotal();?></td>
                            <td> - <?php echo $item->getDiscountPercentage();?></td>
                            <td> - <?php echo $item->getDiscountTotal();?></td>
                            <td><strong><?php echo $item->getNetTotal();?></strong></td>
                        </tr>
                    <?php }; ?>
                    </table>
                    <table class="table table-striped table-bordered pull-right" style="width:40%">
                        <tr>
                            <th>Item Price Total:</th>
                            <td><?php echo $invoice->getItemPriceTotal(); ?></td>
                        </tr>
                        <tr>
                            <th>Item Discount Total:</th>
                            <td> - <?php echo $invoice->getItemDiscountTotal(); ?></td>
                        </tr>
                        <tr>
                            <th>Item NetTotal:</th>
                            <td><?php echo $invoice->getNetTotal(); ?></td>
                        </tr>
                        <tr>
                            <th>VAT:</th>
                            <td><?php echo $invoice->getTaxTotal(); ?></td>
                        </tr>
                        <tr>
                            <th><h3>Gross Total:</h3></th>
                            <td><h3><strong><?php echo $invoice->getGrossTotal(); ?></strong></h3></td>
                        </tr>
                    </table>
                </div><!--/.col-->
            </div><!--/.row-->
        </div><!--/.well-->
    </div><!--/.container-->
    <script src="js/scripts.js"></script>
</body>
</html>