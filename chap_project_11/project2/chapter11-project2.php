<!DOCTYPE html>
<html lang="en">

<?php include 'data.inc.php'; ?>

<head>
    <meta charset="utf-8">
    <title>Chapter 7</title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</head>

<body>
    
<!-- The drawer is always open in large screens. The header is always shown,
  even in small screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
  <?php include 'header.inc.php'; ?>
  <?php include 'left.inc.php'; ?>
  
  <main class="mdl-layout__content mdl-color--grey-50">
    <header class="mdl-color--blue-grey-200">
      <h4>Order Summaries</h4>
      <p>Examine your customer orders</p>
    </header>   
    <section class="page-content">
    
        <div class="mdl-grid">

          <!-- mdl-cell + mdl-card -->
          <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
            <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
              <h2 class="mdl-card__title-text">My Orders</h2>
            </div>
            <div class="mdl-card__supporting-text">            
                <ul class="mdl-list">
                    <?php
                    for ($i=500; $i<550; $i+=10) {
                      echo '<li> <a href="#">Order #'.$i.'</a></li>';
                    }
                    ?>
                </ul>   
            </div>    
          </div>  <!-- / mdl-cell + mdl-card -->




          <!-- mdl-cell + mdl-card -->
          <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
            <div class="mdl-card__title mdl-color--orange">
              <h2 class="mdl-card__title-text">Selected Order: #520</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <table class="mdl-data-table  mdl-shadow--2dp">
                 <caption>Customer: <strong>Mount Royal University</strong></caption>
                  <thead>
                    <tr>
                      <th>Cover</th>
                      <th class="mdl-data-table__cell--non-numeric">Title</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <?php
                        $subtotal = 0;
                        $shipping = 0;
                        $grandtotal = 0;
                        
                        $subtotal += $quantity1 * $price1;
                        $subtotal += $quantity2 * $price2;
                        $subtotal += $quantity3 * $price3;
                        $subtotal += $quantity4 * $price4;
                        
                        
                        if ($subtotal < 10000) {
                          $shipping = 200.00;
                        } else {
                          $shipping = 100.00;
                        }

                        $grandtotal = $subtotal + $shipping;
                    ?>
                      <tr class="totals">
                          <td colspan="4">Subtotal</td>
                          <td>$<?php echo number_format($subtotal,2); ?></td>
                      </tr>
                      <tr class="totals">
                          <td colspan="4">Shipping</td>
                          <td>$<?php echo number_format($shipping,2); ?></td>
                      </tr> 
                      <tr class="grandtotals">
                          <td colspan="4">Grand Total</td>
                          <td>$<?php echo number_format($grandtotal,2); ?></td>
                      </tr>                            
                  </tfoot>          
                  <tbody>
                    <?php
                    function outputOrderRow($file, $title, $quantity, $price) {
                      echo '<tr>';
                      echo '<td><img src="images/books/tinysquare/'.$file.'"></td>';
                      echo '<td class="mdl-data-table__cell--non-numeric">'.$title.'</td>';
                      echo '<td>'.$quantity.'</td>';
                      echo '<td>$'.number_format($price, 2).'</td>';
                      echo '<td>$'.number_format(($quantity*$price), 2).'</td>';
                      echo '</tr>';
                    }

                    outputOrderRow($file1, $title1, $quantity1, $price1);
                    outputOrderRow($file2, $title2, $quantity2, $price2);
                    outputOrderRow($file3, $title3, $quantity3, $price3);
                    outputOrderRow($file4, $title4, $quantity4, $price4);
                    ?>
                  </tbody>

                </table>
            </div>

          </div>  <!-- / mdl-cell + mdl-card -->




        </div>  <!-- / mdl-grid -->
    

    </section>
  </main>
  
  
</div>
          
</body>
</html>