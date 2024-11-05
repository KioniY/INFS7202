<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See menu</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .bg-body-tertiary {
        width: 280px; 
        height: auto; 
        overflow-y: auto;

        }
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
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .category-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-top: 20px; 
    width: 100%; 
    clear: both;
    text-align: center;
    padding: 5px 10px;
    background-color: #d5f2cc;
    
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

    .product-name {
    font-size: 1.8vw; 
}

.product-price, .product-description {
    font-size: 1.5vw; 
}

.add-button {
    font-size: 1.5vw; 
    min-width: 50px; 
    min-height: 20px; 
}


    @media (max-width: 768px) {
    .bg-body-tertiary {
        width:120px; 
        height: auto; 
        overflow-y: auto;
    }
    .content {
        margin-top: 60px; 
        width: 100%;
    }
    .square {
        flex: 1 1 100%; 
        padding-top: 56%; 
    }
    .add-button {
        font-size: 1rem; 
        padding: 10px 15px; 
    }
    
}

@media (max-width: 768px) {
    .product-name {
        font-size: 10px; 
    }

    .product-price,
    .product-description {
        font-size: 8px;
    }

    .add-button {
        font-size: 8px;
        width: 15px;
        height: 10px;
    }
}


    </style>
</head>
<body  style="background-color: DarkSeaGreen;">
<main>
    <!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary">
    <span class="fs-4">Menu System</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach ($categories as $category): ?>
            <li class="nav-item">
                <a href="#<?= $category['category_name']; ?>" class="nav-link link-body-emphasis"><?= $category['category_name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <strong>Shopping chart</strong>
    <button id="cartButton" class="btn btn-primary mt-3">Open Cart</button>
</div>




<!-- Main Content -->
<div class="content" id="content">
    <?php foreach ($categories as $category): ?>
        <div class="category-title"><?= $category['category_name'] ?></div>
        <?php foreach ($products as $product): ?>
            <?php if ($product['category_id'] == $category['category_id']): ?>
                <div class="square">
                    <div class="square-content" data-product-id="<?= esc($product['product_id']) ?>">
                        <span class="product-name"><?= esc($product['product_name']) ?></span><br>
                        <span class="product-price">Price: <?= esc($product['price']) ?></span><br>
                        <span class="product-description"><?= esc($product['description']) ?></span><br>
                        <input type="hidden" class="productId" name="productId" value="<?= esc($product['product_id']) ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <input type="hidden" name="table_id" value="<?= $table_id ?>">
                    </div>
                    <button class="add-button">Add</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>



<!-- Shopping Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="checkoutForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cartContents">
                        <!-- Cart contents will dynamically display here -->
                    </div>
                    <p>Total: $<span id="totalPrice">0.00</span></p>
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="table_id" value="<?= $table_id ?>">
                    <input type="hidden" name="total_price" id="hiddenTotalPrice">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
<!-- Back to top button -->
<button id="back-to-top" onclick="scrollToTop()">Back to Top</button>
    


</main>




    <!-- This script includes all of Bootstrap's JavaScript-based components and behaviors, such as modal windows, dropdowns, and tooltips.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



<!-- Custom JavaScript -->
<script>


// Add event listener to the "Open Cart" button
document.getElementById('cartButton').addEventListener('click', function() {
    var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    cartModal.show();
});

// Initialize cart as an empty array
var cart = [];

// Function to add a product to the cart
function addToCart(productName, price, productId) {
    var found = cart.find(p => p.id === productId);
    if (found) {
        found.qty++;
    } else {
        cart.push({ id: productId, name: productName, price: parseFloat(price), qty: 1 });
    }
    updateCartDisplay();
}

// Initialize and show the modal on button click
document.querySelectorAll('.add-button').forEach(button => {
    button.addEventListener('click', function() {
        var square = button.closest('.square');
        var productId = square.querySelector('.productId').value;
        var productName = square.querySelector('.product-name').textContent;
        var price = square.querySelector('.product-price').textContent.split(":")[1].trim();
        addToCart(productName, price, productId);
        updateCartDisplay(); 
        new bootstrap.Modal(document.getElementById('cartModal')).show();
    });
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


    //
    function updateCartDisplay() {
    var cartContents = document.getElementById('cartContents');
    cartContents.innerHTML = ""; // Clear current contents
    var total = 0;
    cart.forEach(item => {
        var itemTotal = item.price * item.qty;
        total += itemTotal;
        console.log(`Adding item: ${item.name}, Price: ${item.price}, Qty: ${item.qty}, Item total: ${itemTotal.toFixed(2)}, Total so far: ${total.toFixed(2)}`);
        cartContents.innerHTML += `<p>${item.name} - $${item.price} x ${item.qty} = $${itemTotal.toFixed(2)}</p>`;
    });
    document.getElementById('totalPrice').textContent = total.toFixed(2);
    document.getElementById('hiddenTotalPrice').value = total.toFixed(2);
}
let cartModal;

document.addEventListener("DOMContentLoaded", function() {
    
    var form = document.getElementById('checkoutForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var data = {
            user_id: form.querySelector('[name="user_id"]').value,
            table_id: form.querySelector('[name="table_id"]').value,
            totalPrice: form.querySelector('#hiddenTotalPrice').value,
        };

    
        cart.forEach((item, index) => {
            data[`product_name_${index + 1}`] = item.name;
            data[`quantity_${index + 1}`] = item.qty;
        });

        console.log(data); // Debugging to see what is being sent

        fetch('<?= site_url("checkout") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert('Order processed successfully.');
            console.log("Before clearCart");
            clearCart();
            console.log("Before hiding modal");
            bootstrap.Modal.getInstance(document.getElementById('cartModal')).hide();
            console.log("After hiding modal");
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to process order.');
        });
    });
});

function clearCart() {
    cart = []; 
    updateCartDisplay(); 
    document.getElementById('totalPrice').textContent = "0.00"; 
    document.getElementById('hiddenTotalPrice').value = "0.00"; 
    
}



</script>


</body>
</html>