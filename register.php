<?php
if (isset($_GET['error']) && $_GET['error'] == 'email_taken') {
    echo '<div class="alert alert-danger text-center">Email already taken! Please choose another email.</div>';
}
?>
<?php
require_once 'includes/dbc.inc.php';
$student = 0;
if (isset($_GET['student'])) {
    $student = $_GET['student'];
}

try {
    $sql = "SELECT * FROM students;";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 card p-5">
            <?php if (isset($_GET['first'])) : ?>
                <div class="alert alert-warning text-center">
                    Sigeg back bisag wala na!
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])) : ?>
                <div class="alert alert-success text-center">
                    Na save na ang imong studyante!
                </div>
            <?php endif; ?>

            <form action="includes/save.inc.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                    </div>
                </div>
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
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="middlename" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact number</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                </div>
                <div class="text-center mt-5">
                <button type="submit" class="btn btn-success">Save</button>
                    <a href="index.php" class="btn btn-secondary">Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
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
