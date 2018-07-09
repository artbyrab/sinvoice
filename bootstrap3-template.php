<?php

// Uncomment the below if you need to see errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;

// lets create our new invoice
$invoice = new Invoice();
$invoice->number = "54678";
$invoice->supplier = "Grant's Baseball Store, 1 High Street, London, England";
$invoice->customer = "Frank Castle, 10 Main Street, Exeter, England";
$invoice->customerShippingAddress = $invoice->customer;

// add an item
$itemA = new Item();
$itemA->price = 2;
$itemA->quantity = 10;
$itemA->name = 'Baseball Sticker Pack';
$invoice->addItem($itemA);

// add another item
$itemB = new Item();
$itemB->price = 20.0;
$itemB->quantity = 2;
$itemB->name = 'Baseball Sticker Book';
$invoice->addItem($itemB);

// calculate the totals
$invoice->calculateTotals();
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

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
        <nav class="navbar navbar-inverse">
            <a class="navbar-brand" href="#">Sinvoice</a>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="bootstrap3-template.php">Bootstrap 3 Invoice</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="well">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Invoice #<?php echo $invoice->number; ?></h2>
                </div><!--/.col-->
                <div class="col-lg-6">
                </div><!--/.col-->
                <div class="col-lg-12">
                    <hr>
                </div><!--/.col-->
                <div class="col-lg-12">
                    <h3>Invoice From:</h3>
                    <p><?php echo $invoice->supplier; ?></p>
                </div><!--/.col-->
                <div class="col-lg-6">
                    <h3>Invoice Details:</h3>
                    Invoice Issued date: <?php echo $invoice->createdDate; ?><br>
                    Invoice Due date: <?php echo $invoice->dueDate; ?><br>
                </div><!--/.col-->
                <div class="col-lg-12">
                    <hr>
                    <h3>Bill To:</h3>
                    <p><?php echo $invoice->customer; ?><p><br>
                    <strong>Customer Shipping Address</strong>
                    <?php echo $invoice->customerShippingAddress; ?><br>
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
                            <th>Tax Total</th>
                            <th>Total</th>
                        </tr>
                    <?php foreach ($invoice->getItems() as $item) { ?>
                        <tr>
                            <td><?php echo $item->name;?></td>
                            <td><?php echo $item->price;?></td>
                            <td><?php echo $item->quantity;?></td>
                            <td><?php echo $item->getPriceTotal();?></td>
                            <td><?php echo $item->discountPercentage;?></td>
                            <td><?php echo $item->getDiscountTotal();?></td>
                            <td><?php echo $item->getTaxTotal();?></td>
                            <td><strong><?php echo $item->getTotal();?></strong></td>
                        </tr>
                    <?php }; ?>
                    </table>
                    <table class="table table-striped table-bordered pull-right" style="width:40%">
                        <tr>
                            <th>SubTotal:</th>
                            <td><?php echo $invoice->subTotal; ?></td>
                        </tr>
                        <tr>
                            <th>Discount Total:</th>
                            <td><?php echo $invoice->discountTotal; ?></td>
                        </tr>
                        <tr>
                            <th>VAT:</th>
                            <td><?php echo $invoice->taxTotal; ?></td>
                        </tr>
                        <tr>
                            <th><h3>Total:</h3></th>
                            <td><h3><strong><?php echo $invoice->total; ?></strong></h3></td>
                        </tr>
                    </table>
                </div><!--/.col-->
            </div><!--/.row-->
        </div><!--/.well-->
    </div><!--/.container-->
    <script src="js/scripts.js"></script>
</body>
</html>