<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_page</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/register.css'); ?>">
</head>
<body>

    <!-- This is the login function -->
    <div class="container">
    <div class="header">
        <h2>Login</h2>
    </div>
    <form class="form" action="<?=base_url('login')?>" method="post">
         <div class="form-control">
            <input type="text" placeholder="e-mail" id="email" name="email" required />
            <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'email'):''?></span>
        </div>
        <div class="form-control">
            <input type="password" placeholder="password" id="password" name="password" required/>
            <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'password'):''?></span>
        </div>
        <input type="submit" class="button_a1" value="Login">
        
        <!-- register -->
        <a href="<?= base_url('register'); ?>" class="button_a">Register</a>
    </form>
</div>




    <!-- This script includes all of Bootstrap's JavaScript-based components and behaviors, such as modal windows, dropdowns, and tooltips.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>