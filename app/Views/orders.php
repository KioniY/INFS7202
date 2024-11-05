<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        main {
            display: flex;
            min-height: 100%; 
        }
        .d-flex {
            height: 100%; 
        }
        h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 20px; 
            width: 100%; 
            clear: both;
            text-align: center;
            padding: 5px 10px;
            background-color: #d5f2cc;}
        #back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: none;
    }
    #back-to-top.show{
        display: block;
    }

    </style>
</head>
<body  style="background-color: DarkSeaGreen;">
<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px; height: auto;">
        <span class="fs-4">Menu System</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= base_url('home'); ?>" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Home
            </a>
        </li>
        <li>
            <a href="<?= base_url('category'); ?>" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Category
            </a>
        </li>
        <li>
            <a href="<?= base_url('products'); ?>" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Products
            </a>
        </li>
        <li>
            <a href="<?= base_url('orders'); ?>" class="nav-link active" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            Orders
            </a>
        </li>
  
        </ul>
        <hr>
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person rounded-circle me-2" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
    </svg>
            <strong>user</strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="<?= base_url('menu/profile'); ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('menu/logout'); ?>">Sign out</a></li>
        </ul>
        </div>
  </div>


  <!-- This is Orders -->
  <div class="container-fluid">
    <div class="row">
        <div class="col">
  <div class="container">
    <h1>Pending Orders</h1>
    <div class="list-group">
        <?php foreach ($pendingOrders as $order): ?>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Order ID: <?= $order['order_id']; ?></h5>
                    <small>Status: <?= $order['status']; ?></small>
                </div>
                <p class="mb-1">Product Name: <?= $order['product_name']; ?></p>
                <small>Quantity: <?= $order['quantity']; ?></small>
                <small>Table Number: <?= $order['table_number'] ?? 'N/A'; ?></small>
                <div class="mt-2">
                    <!-- BUTTONS -->
                    <button type="button" class="btn btn-success finish-order" data-order-id="<?= $order['order_id']; ?>">Finish</button>
                    <button type="button" class="btn btn-danger cancel-order" data-order-id="<?= $order['order_id']; ?>">Cancel</button>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<!-- finished orders -->
<div class="container">
    <h1>Finished Orders</h1>
    <div class="list-group">
        <?php foreach ($finishedOrders as $order): ?>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Order ID: <?= $order['order_id']; ?></h5>
                    <small>Status: <?= $order['status']; ?></small>
                </div>
                <p class="mb-1">Product Name: <?= $order['product_name']; ?></p>
                <small>Quantity: <?= $order['quantity']; ?></small>
                <small>Table Number: <?= $order['table_number'] ?? 'N/A'; ?></small>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="container">
    <h1>Canceled Orders</h1>
    <div class="list-group">
        <?php foreach ($canceledOrders as $order): ?>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Order ID: <?= $order['order_id']; ?></h5>
                    <small>Status: <?= $order['status']; ?></small>
                </div>
                <p class="mb-1">Product Name: <?= $order['product_name']; ?></p>
                <small>Quantity: <?= $order['quantity']; ?></small>
                <small>Table Number: <?= $order['table_number'] ?? 'N/A'; ?></small>
            </a>
        <?php endforeach; ?>
    </div>
</div>
</div>
    </div>
</div>


 <!-- Back to top button -->
 <button id="back-to-top" onclick="scrollToTop()">Back to Top</button>




</main>
<script>
    // If Finish
    document.querySelectorAll('.finish-order').forEach(function(button) {
        button.addEventListener('click', function() {
            var orderId = this.getAttribute('data-order-id');
            finishOrder(orderId, 'Finish');
        });
    });

    // If cancel
    document.querySelectorAll('.cancel-order').forEach(function(button) {
        button.addEventListener('click', function() {
            var orderId = this.getAttribute('data-order-id');
            cancelOrder(orderId, 'Cancel');
        });
    });

   
    // FINISH
    function finishOrder(orderId, status) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/menu/checkout/finish/' + orderId, true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                location.reload(); 
            }
        };
        xhr.send();
    }

    // CANCEL
    function cancelOrder(orderId, status) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/menu/checkout/cancel/' + orderId, true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                location.reload(); 
            }
        };
        xhr.send();
    }

    // back to top function
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
                var backToTopButton = document.getElementById("back-to-top");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    backToTopButton.style.display = "block";
                } else {
                    backToTopButton.style.display = "none";
                }

            }

            function scrollToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
</script>




    <!-- This script includes all of Bootstrap's JavaScript-based components and behaviors, such as modal windows, dropdowns, and tooltips.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>