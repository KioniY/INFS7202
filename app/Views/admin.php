<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .container {
            text-align: center; 
            margin-top: 50px; 
        }

        .title {
            color: #ffffff; 
            margin-bottom: 30px; 
        }

        .add-btn {
            position: relative; 
            margin-bottom: 20px;
            left: 100px;
            z-index: 1000; 
        }
    </style>
   
</head>
<body  style="background-color: DarkSeaGreen;">
<main>
<div class="container">
    <h1 class="title">User Management</h1>
    <!-- Add button and sign out button -->
    <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="btn btn-primary add-btn mb-3" onclick="openAddUserModal()">Add New User</a>
            <button class="btn btn-warning" onclick="window.location.href='<?= base_url('menu/logout'); ?>'">Sign out</button>
    </div>



    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['user_id']) ?></td>
                <td><?= esc($user['user_name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['phone']) ?></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="openEditUserModal(<?= $user['user_id'] ?>, '<?= $user['user_name'] ?>', '<?= $user['email'] ?>')"><i class="bi bi-pencil-square"></i></a>
                    <a href="javascript:void(0);" class="btn btn-danger" onclick="openDeleteUserModal(<?= $user['user_id'] ?>)"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<!-- Edit User Modal Container -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editUserForm" action="<?= base_url('/user1/update') ?>" method="post">
            <input type="hidden" name="user_id" id="editUserId"> 
            <input type="hidden" name="_method" value="PUT"> 

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="editUserName" name="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="email">
                    </div>
                    <!-- Add other fields as necessary -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>






<!-- Delete User Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/user1/delete') ?>" method="post">
                <input type="hidden" name="_method" value="DELETE"> <!-- Method spoofing for DELETE -->
                <div class="modal-body">
                    Are you sure you want to delete this user?
                    <input type="hidden" name="user_id" id="deleteUserId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addUserForm" action="<?= base_url('/user1/create') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addUserName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="addUserName" name="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="addUserPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="addUserPassword" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </form>
    </div>
</div>





</main>
<script>
function openEditUserModal(userId, userName, userEmail) {
    document.getElementById('editUserId').value = userId; 
    document.getElementById('editUserName').value = userName;
    document.getElementById('editUserEmail').value = userEmail;
    var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editModal.show();
}


function openDeleteUserModal(userId) {
    document.getElementById('deleteUserId').value = userId;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
    deleteModal.show();

    // Set up the form submission event listener once the modal is opened
    document.addEventListener('DOMContentLoaded', function() {
    const deleteForm = document.querySelector('#deleteUserModal form');
    deleteForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser

        const userId = document.getElementById('deleteUserId').value;
        fetch(deleteForm.action, {
            method: 'POST', // POST must be used because browsers do not support form submission with DELETE
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `user_id=${userId}&_method=DELETE` // Ensure the method override and user ID are included in the body
        })
        .then(response => {
            if (response.ok) {
                return response.json(); // or handle redirection if needed
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            console.log('Success:', data);
            window.location.reload(); // Reload the page to see the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

}


function openAddUserModal() {
    document.getElementById('addUserForm').reset(); // Reset form in case it was previously filled
    var addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
    addUserModal.show();
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser
        const form = this;
        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(new FormData(form)).toString()
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            console.log('Success:', data);
            window.location.reload(); // Reload the page to see the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

}











</script>

    




    <!-- This script includes all of Bootstrap's JavaScript-based components and behaviors, such as modal windows, dropdowns, and tooltips.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>