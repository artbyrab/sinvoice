<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
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
        <?php include "_nav.php"; ?> 
        <div class="jumbotron">
            <div class="container">
                <h1>Welcome to Sinvoice</h1>
                <p>It would be a sin, not to use Sinvoice for your invoicing needs.</p>
                <p>
                    <a href="bootstrap3-template.php" class="btn btn-primary btn-lg">Bootstrap 3 Template</a>
                </p>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>