<?php
require_once 'dbc.inc.php'; //Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Fetching form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Check if email exists in the students table
    try {
        $sql = "SELECT * FROM students WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student['password'])) {
            //Student authenticated successfully
            session_start();
            $_SESSION['student_id'] = $student['id'];
            header('Location: user.php');
            exit();
        } else {
            //Login failed
            $error_message = "Failed to login. Email or password incorrect.";
        }
    } catch (PDOException $e) {
        // Handle database error
        die("Query failed: " . $e->getMessage());
    }
}



// Set error message if login failed
$error_message = isset($error_message) ? $error_message : '';

?>
