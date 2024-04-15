<?php
session_start();

//Check if the user clicked the sign-out button
if (isset($_POST['signout'])) {
    // Close all session data
    session_destroy();

    // Set a session variable indicating logout
    $_SESSION['logged_out'] = true;

    // Redirect to index.php after signing out
    header('Location: index.php');
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    // Redirect if user is not logged in
    header('Location: index.php');
    exit();
}

// Include database connection file
require_once 'includes/dbc.inc.php';

// Get user data from the database
$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM students WHERE id = :student_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':student_id', $student_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data exists
if ($user) {
    // Display user information
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5">
                <h2 class="text-center mb-4">User Profile</h2>
                <div class="text-center mb-4">
                    <?php if ($user['image']) : ?>
                        
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($user['image']); ?>" alt="Profile Image" class="img-fluid">
                    <?php else : ?>
                        <p>No profile image available</p>
                    <?php endif; ?>
                </div>
                <ul class="list-group">
                    <!-- Displaying all user details -->
                    <li class="list-group-item"><strong>First Name:</strong> <?php echo $user['firstname']; ?></li>
                    <li class="list-group-item"><strong>Last Name:</strong> <?php echo $user['lastname']; ?></li>
                    <li class="list-group-item"><strong>Middle Name:</strong> <?php echo $user['middlename']; ?></li>
                    <li class="list-group-item"><strong>Suffix:</strong> <?php echo $user['suffix']; ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo $user['email']; ?></li>
                    <li class="list-group-item"><strong>Password:</strong> <?php echo $user['password']; ?></li>
                    <li class="list-group-item"><strong>Birthday:</strong> <?php echo $user['birthday']; ?></li>
                    <li class="list-group-item"><strong>Address:</strong> <?php echo $user['address']; ?></li>
                    <li class="list-group-item"><strong>Contact Number:</strong> <?php echo $user['contact']; ?></li>
                    <!-- Add more user details here -->
                </ul>
                <div class="text-center mt-4">
                    <!-- Sign out button -->
                    <form action="" method="post">
                    <button type="submit" name="signout" class="btn btn-success">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
} else {
    echo "<p class='text-center'>User not found.</p>";
}
?>
