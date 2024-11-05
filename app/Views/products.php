<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            min-width: 320px;
        }
        main {
            display: flex;
            min-height: 100%; 
        }
        .d-flex {
            height: 100%; 
        }
        /* .sidebar {
            width: 280px;
            flex-shrink: 0;
            height: 100%;
            overflow-y: auto;
        } */
        .content {
            flex-grow: 1;
            padding: 20px; /* Adjust padding as needed */
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the gap between squares */
        }
        .square {
            flex: 1 1 calc(50% - 20px); /* Adjust width calculation based on gap */
            height: 0;
            padding-top: calc(50% - 20px); /* Height equals to its width */
            background-color: #f8f9fa;
            border: 2px solid #dee2e6; /* Adjust border style as needed */
            position: relative;
            border-radius: 10px;
        }
        .square-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .add-button {
            flex-basis: 100%; /* Ensure the button takes full width */
            order: 999; /* Make sure it stays at the bottom */
            margin-top: auto; /* Push the button to the bottom */
        }
        .content .product-header {
            width: 100%;
            margin-bottom: 2px; 
        }
        .product-name {
            font-size: 2.0vw;
            letter-spacing: 0.1vw;
            line-height: clamp(1.2em, 2.7vw, 1.4em);
            }

    .product-price {
        font-size: 1.8vw;
        letter-spacing: 0.08vw;
        line-height: clamp(1.2em, 2.5vw, 1.4em);
    }

    .product-description {
        font-size: 1.5vw; 
        letter-spacing: 0.06vw;
        line-height: clamp(1.2em, 2.3vw, 1.4em);
    }

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
    <!-- This is sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px !important; height: auto !important; overflow-y: auto !important;">
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
            <a href="<?= base_url('products'); ?>" class="nav-link active" aria-current="page">
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
            <li><a class="dropdown-item" href="<?= base_url('menu/profile'); ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('menu/logout'); ?>">Sign out</a></li>
        </ul>
        </div>
  </div>


  <!-- This is products -->
<div class="content" id="content">
    <?php if (isset($category) && is_array($category)): ?>
        <h2 class="product-header">Category: <?= esc($category['category_id']) ?> - <?= esc($category['category_name']) ?></h2>
        <!-- <?php if (empty($products)): ?>
            <p>No products found in this category.</p>
        <?php else: ?> -->
            <?php foreach ($products as $product): ?>
                <div class="square">
                    <div class="square-content" data-product-id="<?= esc($product['product_id']) ?>">
                        <span class="product-name"><?= esc($product['product_name']) ?></span><br>
                        <span class="product-price">Price: <?= esc($product['price']) ?></span><br>
                        <span class="product-description">Description: <?= esc($product['description']) ?></span><br>
                        <input type="hidden" class="productId" name="productId" value="<?= esc($product['product_id']) ?>">
                        <input type="hidden" class="categoryId" value="<?= esc($category['category_id']) ?>">
                        <?php if (isset($category['category_id'])): ?>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm edit-product" data-bs-toggle="modal" data-bs-target="#productModal">
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm delete-product" onclick="return confirm('Are you sure you want to delete this product?')">
                                Delete
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php else: ?>
        <h2 class="product-header">All Products</h2>
        <?php if (empty($products)): ?>
            <p>No products available.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="square">
                    <div class="square-content" data-product-id="<?= esc($product['product_id']) ?>">
                        <span class="product-name fs-5 fs-md-4 fs-lg-3 fs-xl-2"><?= esc($product['product_name']) ?></span><br>
                        <span class="product-price fs-6 fs-md-5 fs-lg-4">Price: <?= esc($product['price']) ?></span><br>
                        <span class="product-description fs-6 fs-md-5 fs-lg-4">Description: <?= esc($product['description']) ?></span><br>
                        <input type="hidden" class="productId" name="productId" value="<?= esc($product['product_id']) ?>">

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>

    <!-- This is Add button -->
    <?php if (isset($category) && is_array($category)): ?>
        <button id="addProduct" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#productModal">Add Product</button>
    <?php endif; ?>
</div>









 <!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Manage Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                
                    <input type="hidden" id="productId" name="productId" value="">
                    <input type="hidden" id="categoryId" name="category_id" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveProduct">Save</button>
            </div>
        </div>
    </div>
</div>




        <!-- Template for new product square -->
        <template id="productTemplate">
            <div class="square">
            <div class="square-content">
            <span class="product-name fs-5 fs-md-4 fs-lg-3 fs-xl-2"></span><br>
            <span class="product-price fs-6 fs-md-5 fs-lg-4"></span><br>
            <span class="product-description fs-6 fs-md-5 fs-lg-4"></span><br>
            <input type="hidden" class="productId" name="productId" id="productId"  value="">
            <input type="hidden" class="categoryId" name="categoryId">
            <button type="button" class="btn btn-primary btn-sm edit-product" data-bs-toggle="modal" data-bs-target="#productModal">
            Edit
            </button>
            <button type="button" class="btn btn-danger btn-sm delete-product" onclick="return confirm('Are you sure you want to delete this product?')">
            Delete
            </button>
            </div>
            </div>
        </template>

<!-- Back to top button -->
<button id="back-to-top" onclick="scrollToTop()">Back to Top</button>


    
    


</main>


<script>

        let category_id = new URLSearchParams(window.location.search).get('category_id');
        console.log("Category ID from URL:", category_id);
        // Add Product Button Click
        // if category_id exist， addProduct 
        if (category_id) {
            document.getElementById('addProduct').addEventListener('click', function() {
                document.getElementById('productModalLabel').textContent = 'Add Product';
                document.getElementById('productForm').reset();
                document.getElementById('productId').value = '';
                document.getElementById('categoryId').value = category_id;
            });
        }

        // Edit Product Button Click
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-product')) {
                const squareContent = event.target.closest('.square-content');
                const productId = squareContent.dataset.productId;
                const categoryId = squareContent.querySelector('.categoryId').value;
                const productName = squareContent.querySelector('.product-name').textContent;
                const productPrice = squareContent.querySelector('.product-price').textContent.replace('Price: ', '');
                const productDescription = squareContent.querySelector('.product-description').textContent;

                console.log("Editing Product:", { productId, productName, productPrice, productDescription });

                document.getElementById('productModalLabel').textContent = 'Edit Product';
                document.getElementById('product_name').value = productName;
                document.getElementById('price').value = productPrice;
                document.getElementById('description').value = productDescription;
                document.getElementById('productId').value = productId;
                document.getElementById('categoryId').value = categoryId;
            }
        });

        // Save Product
        document.getElementById('saveProduct').addEventListener('click', function() {
            const form = document.getElementById('productForm');
            const formData = new FormData(form);
            const productId = formData.get('productId');
            const data = Object.fromEntries(formData.entries());

            console.log("Save Product Data:", {data});
            console.log("JSON Data Sent in POST Request:", JSON.stringify(data)); // 检查发送的数据


            if (!data.category_id) {
                console.error('category_id is missing in the data sent.');
                return; 
            }

            if (productId) {
                fetch(`<?= base_url("product1"); ?>/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        const productElement = document.querySelector(`[data-product-id="${data.productId}"]`);
                        if (!productElement) {
                            console.error('Product element not found for the given ID:', data.productId);
                            return;
                        }
                        productElement.querySelector('.product-name').textContent = data.product_name;
                        productElement.querySelector('.product-price').textContent = `Price: ${data.price}`;
                        productElement.querySelector('.product-description').textContent = data.description;
                        bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
                        showAlert('Product updated successfully.', 'success');
                    }
                })
                .catch(error => {
                    console.error('Error updating product:', error);
                });
            } else {
                // Add new product
                console.log("JSON Data Sent in POST Request:", JSON.stringify(data));

                fetch('<?= base_url("product1"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    console.log("Response received from server:", response);
                    return response.json();
        })
                .then(data => {
                    console.log("Response from POST request:", data); 
                    if (data) {
                        const template = document.getElementById('productTemplate');
                        const clone = document.importNode(template.content, true);
                        clone.querySelector('.product-name').textContent = data.product_name;
                        clone.querySelector('.product-price').textContent = `Price: ${data.price}`;
                        clone.querySelector('.product-description').textContent = data.description;
                        clone.querySelector('.productId').value = data.product_id;
                        clone.querySelector('.categoryId').value = data.category_id;
                        

                        const addButton = document.getElementById('addProduct');
                        const container = addButton.parentNode; 

                        // insert before the button
                        container.insertBefore(clone, addButton);
                        bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
                        window.location.reload();
                        
                    }
                })
                .catch(error => {
                    console.error('Error adding or updating product:', error);
                    console.error('Error adding product:', error);
                });
            }
        });
        

        // Delete Product Button Click
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-product')) {
                const squareContent = event.target.closest('.square-content');
                const productId = squareContent.dataset.productId;
                const confirmation = confirm('Are you sure you want to delete this product?');

                if (confirmation) {
                    fetch(`<?= base_url("product1"); ?>/${productId}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            event.target.closest('.square').remove();
                            showAlert('Product deleted successfully.', 'success');
                        } else {
                            showAlert('Error deleting product. Please try again.', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('Error deleting product. Please try again.', 'danger');
                    });
                }
            }
        });


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