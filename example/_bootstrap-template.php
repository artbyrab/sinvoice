<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-lg-12">
                <h2>Invoice #<?php echo $invoice->getNumber(); ?></h2>
                <strong>Ref: <?php echo $invoice->getReference(); ?></strong><br>
                Invoice Issued date: <?php echo $invoice->getCreatedDate()->format('Y-m-d'); ?><br>
                Invoice Due date: <?php echo $invoice->getDueDate()->format('Y-m-d'); ?><br>
                <hr>
            </div><!--/.col-->
            <div class="col-lg-4">
                <h3>Invoice From:</h3>
                <p><?php echo $invoice->getSupplier(); ?></p>
            </div><!--/.col-->
            <div class="col-lg-4">
                <h3>Bill To:</h3>
                <p><?php echo $invoice->getCustomer(); ?><p><br>  
            </div><!--/.col-->
            <?php if ($invoice->hasShipping()) { ?>
                <div class="col-lg-4">
                    <h3>Ship To:</h3>
                    <p><?php echo $invoice->shipping->getRecipient(); ?><p><br>  
                </div><!--/.col-->
            <?php } ;?>
            <div class="col-lg-12">
                <br>
                <hr>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Price Total</th>
                        <?php if ($invoice->hasDiscount() == True) { ?>
                            <th>Discount</th>
                        <?php } ?>
                        <th>Net Total</th>
                    </tr>
                <?php foreach ($invoice->items->getItems() as $item) { ?>
                    <tr>
                        <td><?php echo $item->getName();?></td>
                        <td><?php echo $item->getPrice();?></td>
                        <td><?php echo $item->getQuantity();?></td>
                        <td><?php echo $item->getPriceTotal();?></td>
                        <?php if ($invoice->hasDiscount() == True) { ?>
                            <td><?php echo $item->getDiscount();?></td>
                        <?php } ?>
                        <td><strong><?php echo $item->getNetTotal();?></strong></td>
                    </tr>
                <?php }; ?>
                </table>
                <table class="table table-striped table-bordered pull-right" style="width:40%">
                    <?php if ($invoice->hasItemDiscount() == True) { ?>
                        <tr>
                            <th>Item Net Total:</th>
                            <td>$<?php echo $invoice->totals->getItemNetTotal(); ?></td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>$<?php echo $invoice->totals->getDiscount(); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Net Total:</th>
                        <td><?php echo $invoice->totals->getNetTotal(); ?></td>
                    </tr>
                    
                    <tr>
                        <th>VAT:</th>
                        <td><?php echo $invoice->totals->getTaxTotal(); ?></td>
                    </tr>
                    <tr>
                        <th><h3>Gross Total:</h3></th>
                        <td><h3><strong><?php echo $invoice->totals->getGrossTotal(); ?></strong></h3></td>
                    </tr>
                </table>
            </div><!--/.col-->
        </div><!--/.row-->
    </div><!--/.well-->
</div><!--/.container-->