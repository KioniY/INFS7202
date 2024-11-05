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
        }
        main {
            display: flex;
            min-height: 100%; 
        }
        .d-flex {
            height: 100%; 
        }
        .sidebar {
            width: 280px;
            flex-shrink: 0;
            height: 100%;
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
            width: 100%; 
            padding: 10px 20px; 
            background-color: blue; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            height: 40px;
            margin-top: auto;
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
            <a href="<?= base_url('category'); ?>" class="nav-link active" aria-current="page">
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
            <li><a class="dropdown-item" href="<?= base_url('menu/profile'); ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('menu/logout'); ?>">Sign out</a></li>
        </ul>
        </div>
  </div>





    <!--this is category  -->
    <div class="content" id="content">
    <?php foreach ($categories as $category): ?>
        <div class="square">
            <div class="square-content" data-category-id="<?= esc($category['category_id']) ?>">
            <span class="category_name"><?= esc($category['category_name']); ?></span>
            <input type="hidden" class="categoryId" name="categoryId" id="<?= esc($category['category_id']) ?>" value="<?= esc($category['category_id']) ?>">
            <input type="hidden" class="userId" value="<?= esc($user['user_id']) ?>">
            <br>
            <a href="<?= base_url('products?category_id=' . $category['category_id']); ?>">View Products</a>
            <br>
            <!-- Edit Button -->
            <button type="button" class="btn btn-primary btn-sm edit-category" data-bs-toggle="modal" data-bs-target="#categoryModal">
                Edit
            </button>

            <!-- Delete Button -->
            <button type="button" class="btn btn-danger btn-sm delete-category" onclick="return confirm('Are you sure you want to delete this category?')">
            Delete
            </button>
            </div>
        </div>
    <?php endforeach; ?>


            <!-- This is Add button -->
            <button type="button" class="add-button" data-bs-toggle="modal" data-bs-target="#categoryModal" id="addbtn"> Add Category </button>

    </div>
    <!-- //Alert for displaying messages -->
    <div id="educationAlert" class="alert alert-dismissible fade show mt-3" role="alert" style="display: none;">
        <span id="educationAlertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>





        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>
                <input type="hidden" id="categoryId" name="categoryId" value="<?= esc($category['category_id']) ?>">
                <input type="hidden" id="userId" name="user_id" value="<?= esc($user['user_id']) ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
            </div>
            </div>
        </div>
        </div>


        <!-- Template for new category square -->
        <template id="categoryTemplate">
    <div class="square">
        <div class="square-content" data-category-id="<?= esc($category['category_id']) ?>">
            <span class="category_name"><?= esc($category['category_name']); ?></span>
            <input type="hidden" class="categoryId" name="categoryId" id="<?= esc($category['category_id']) ?>" value="<?= esc($category['category_id']) ?>">
            <input type="hidden" class="userId">
            <br>
            <a href="#" class="productLink">View Products</a>
            <br>
            <button type="button" class="btn btn-primary btn-sm edit-category" data-bs-toggle="modal" data-bs-target="#categoryModal">Edit</button>
            <button type="button" class="btn btn-danger btn-sm delete-category" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
        </div>
    </div>
</template>



 <!-- Back to top button -->
 <button id="back-to-top" onclick="scrollToTop()">Back to Top</button>

 
</main>




<script>
// Add Category Button Click
document.getElementById('addbtn').addEventListener('click', function() {
    document.getElementById('categoryModalLabel').textContent = 'Add Category';
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryId').value = '';
  });

 // Edit Category Button Click
 document.addEventListener('click', function(event) {
    if (event.target.classList.contains('edit-category')) {
        const squareContent = event.target.closest('.square-content');
        const categoryId = squareContent.querySelector('.categoryId').value;
        const userId = squareContent.querySelector('.userId').value;
        const categoryName = squareContent.querySelector('.category_name').textContent;

        console.log("Editing Category:", { categoryId, userId, categoryName });

        document.getElementById('categoryModalLabel').textContent = 'Edit Category';
        document.getElementById('category_name').value = categoryName;
        document.getElementById('categoryId').value = categoryId;
        document.getElementById('userId').value = userId;

    
    }

    
});

document.getElementById('saveCategory').addEventListener('click', function() {
    const form = document.getElementById('categoryForm');
    const formData = new FormData(form);
    const categoryId = formData.get('categoryId');
    const data = Object.fromEntries(formData.entries());

    console.log("get Category:", { categoryId});
    if (categoryId) {
        console.log("get Category2:", { categoryId});  
        // renew
        fetch(`<?= base_url("category1"); ?>/${categoryId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response Data:', data);
            if (data) {
                const squareContent = document.querySelector(`[data-category-id="${categoryId}"]`);
                squareContent.querySelector('.category_name').textContent = formData.get('category_name');
                bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
                showAlert('Education updated successfully.', 'success');
            }

        })
        .catch(error => {
            console.error('Error updating category:', error);
        });

    } else {
        // add new category
        fetch('<?= base_url("category1"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())  
        .then(data => {
            if (data) {
                const template = document.getElementById('categoryTemplate');
                const clone = document.importNode(template.content, true);
                clone.querySelector('.category_name').textContent = data.category_name;
                clone.querySelector('.categoryId').value = data.category_id;
                clone.querySelector('.userId').value = data.user_id;
                clone.querySelector('.productLink').href = `<?= base_url('products?category_id='); ?>${data.category_id}`;

                const addButton = document.getElementById('addbtn');
                const container = addButton.parentNode; 

                // insert before the button
                container.insertBefore(clone, addButton);
                bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error adding category:', error);
        });
    }
});


  // Delete category Button Click
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-category')) {
        const squareContent = event.target.closest('.square-content');
        const categoryId = squareContent.querySelector('.categoryId').value;
        const confirmation = confirm('Are you sure you want to delete this Category?');

        if (confirmation) {
            fetch(`<?= base_url("category1"); ?>/${categoryId}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    // Category deleted successfully
                    event.target.closest('.square').remove(); // Ensure this selector matches your HTML structure
                    showAlert('Category deleted successfully.', 'success');
                } else {
                    // Error occurred
                    showAlert('Error deleting category. Please try again.', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error deleting category. Please try again.', 'danger');
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