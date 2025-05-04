<?php
include 'includes/book-utilities.inc.php';

// File paths
$customerFile = 'data/customers.txt';
$bookFile = 'data/books.txt';
$orderFile = 'data/orders.txt';

$customers = array();
if (file_exists($customerFile)) {
    $lines = file($customerFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (count(($fields)) >= 12) {
            $customers[$fields[0]] = array(
                'id' => $fields[0],
                'firstName' => $fields[1],
                'lastName' => $fields[2],
                'email' => $fields[3],
                'university' => $fields[4],
                'address' => $fields[5],
                'city' => $fields[6],
                'state' => $fields[7],
                'country' => $fields[8],
                'zip' => $fields[9],
                'phone' => $fields[10],
                'sales' => $fields[11]
            );
        }
    }
}

$orders = array();
if (file_exists($orderFile)) {
    $lines = file($orderFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        if (count($fields) >= 5) {
            $orders[$fields[0]][] = array(
                'orderid' => $fields[0],
                'customerid' => $fields[1],
                'isbn' => $fields[2],
                'title' => $fields[3],
                'category' => $fields[4]
            );
        }
    }
}

$selectedCustomer = null;
if (isset($_GET['customerid']) && array_key_exists($_GET['customerid'], $customers)) {
    $selectedCustomer = $customers[$_GET['customerid']];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chapter 12</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
    
  
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- Customer List -->
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <a href="?customerid=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?>
                                    </a>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $customer['university']; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $customer['city']; ?></td>
                                <td>
                                  <span class="inlinesparkline"><?php echo $customer['sales']; ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>               
                      </tbody>
                    </table>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              
            <div class="mdl-grid mdl-cell--5-col">
    

       
                  <!-- Customer Details -->
                  <!-- mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                    <?php if ($selectedCustomer): ?>
                        <h4><strong><?php echo $selectedCustomer['firstName'] . ' ' . $selectedCustomer['lastName']; ?></strong></h4>
                        <p><?php echo $selectedCustomer['university']; ?></p>
                        <p><?php echo $selectedCustomer['address']; ?></p>
                        <p><?php echo $selectedCustomer['city'] . ', ' . $selectedCustomer['country']; ?></p>
                    <?php else: ?>
                        <p>Please select a customer to view their details.</p>
                    <?php endif; ?>                                                                                                                                   
                    </div>    
                  </div>  <!-- / mdl-cell + mdl-card -->   

                  <!-- Order Details -->
                  <!-- mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selectedCustomer): 
                          $customerOrders = array_filter($orders, function($order) use ($selectedCustomer) {
                              return $order[0]['customerid'] == $selectedCustomer['id'];
                          });
                          if (count($customerOrders) > 0): ?>
                            <table class="mdl-data-table  mdl-shadow--2dp">
                              <thead>
                                <tr>
                                  <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                  <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                  <th class="mdl-data-table__cell--non-numeric">Title</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($customerOrders as $order): ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">
                                          <img src="images/tinysquare/<?php echo $order[0]['isbn']; ?>.jpg" alt="<?php echo $order[0]['title']; ?>" width="50" height="75">                                        </td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $order[0]['isbn']; ?></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $order[0]['title']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            <p>No orders found for <?php echo $selectedCustomer['firstName'] . ' ' . $selectedCustomer['lastName']; ?>.</p>
                          <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p>Please select a customer to view their orders.</p>
                    <?php endif; ?>    
                   </div>  <!-- / mdl-cell + mdl-card -->             


               </div>   
           
           
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 

<script type="text/javascript">
  $(document).ready(function() {
    $('.inlinesparkline').sparkline('html', {
      type: 'bar',
      barColor: '#FF9800'
    });
  });
</script>
</body>
</html>