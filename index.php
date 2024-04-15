<?php
require_once 'includes/login.inc.php'; // Include the login handling file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-ELEC 2 Midterm</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 400px;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .form-label {
            font-weight: bold;
        }
        #togglePassword {
            background-color: transparent;
            border: none;
            outline: none;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center mb-4">Login</h2>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        <i class="far fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Log in</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='register.php'">Register</button>
            </div>
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger mt-4"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- JavaScript for toggling password visibility -->
<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("far", "fa-eye");
            eyeIcon.classList.add("fas", "fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fas", "fa-eye-slash");
            eyeIcon.classList.add("far", "fa-eye");
        }
    });
</script>

</body>
</html>