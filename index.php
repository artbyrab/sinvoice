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
                </li>>
            </ul>
        </nav>
        <div class="jumbotron">
            <div class="container">
                <h1>Welcome to Sinvoice</h1>
                <p>It would be a sin, not to use Sinvoice for your invoicing needs.</p>
                <p>
                    <a href="" class="btn btn-primary btn-lg">Bootstrap 3 Template</a>
                </p>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>