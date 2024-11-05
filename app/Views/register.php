<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register_page</title>
     <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/register.css'); ?>">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Register</h2>
        </div>
        <form id="form" class="form" action="<?=base_url('register')?>" method="post">
            <div class="form-control">
                <input type="text" placeholder="user name" id="user_name" name="user_name" />
                <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'user_name'):''?></span>
                
            </div>
            <div class="form-control">
                <input type="email" placeholder="email" id="email" name="email"/>
                <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'email'):''?></span>
            </div>
            <div class="form-control">
                <input type="password" placeholder="password" id="password" name="password"/>
                <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'password'):''?></span>
            </div>
            <div class="form-control">
                <input type="password" placeholder="confirmed password" id="confirmpassword" name="confirmpassword"/>
                <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'confirmpassword'):''?></span>
            </div>
            <input type="submit" class="button_a1" value="Register">
        </form>
        <br>
        <a href="<?= site_url('');?>"> Already have an account</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>