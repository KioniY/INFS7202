<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            height: 100vh; 
        }
        .d-flex {
            height: 100%; 
        }
        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center; 
        }
        .welcome-message {
            font-size: 24px; 
            font-weight: bold; 
        }
    </style>
</head>
<body  style="background-color: DarkSeaGreen;">
<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <span class="fs-4">Menu System</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= base_url('home'); ?>" class="nav-link active" aria-current="page">
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
            <a href="<?= base_url('orders'); ?>" class="nav-link link-body-emphasis">
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
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('menu/logout'); ?>">Sign out</a></li>
        </ul>
        </div>
  </div>


  <div class="content">

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4">Edit User</h2>
                <form method="post" action="/menu/menu/profile/edit">
                    <div class="mb-3 row">
                        <label for="user_name" class="col-md-5 col-form-label">Name</label>
                        <div class="col-md-15">
                            <input type="text" class="form-control" id="user_name" name="user_name" value="<?= esc($userInfo['user_name']) ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-5 col-form-label">Email</label>
                        <div class="col-md-15">
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($userInfo['email']) ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-md-5 col-form-label">Phone</label>
                        <div class="col-md-15">
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?= esc($userInfo['phone']) ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-md-5 col-form-label">Address</label>
                        <div class="col-md-15">
                            <input type="text" class="form-control" id="address" name="address" value="<?= esc($userInfo['address']) ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tableNum" class="col-md-5 col-form-label">Table Number</label>
                        <div class="col-md-15">
                            <input type="text" class="form-control" id="tableNum" name="tableNum" value="<?= esc($userInfo['tableNum']) ?>">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
</div>



</main>



    <!-- This script includes all of Bootstrap's JavaScript-based components and behaviors, such as modal windows, dropdowns, and tooltips.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>