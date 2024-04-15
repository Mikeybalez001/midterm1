<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'dbc.inc.php';

    // Fetching form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // New field
    $birthday = $_POST['birthday'];
    $middlename = $_POST['middlename'];
    $suffix = $_POST['suffix'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $id = $_POST['id'];

    // File upload handling
    $image = $_FILES['profile_picture'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_type = $image['type'];

    // Check if the file is an image
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image_type, $allowed_types)) {
        header('Location: ../register.php?invalid_image');
        exit();
    }

    // Read the contents of the image file
    $image_content = file_get_contents($image_tmp);

    try {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $sql_check_email = "SELECT COUNT(*) AS count FROM students WHERE email = :email";
        $stmt_check_email = $pdo->prepare($sql_check_email);
        $stmt_check_email->bindParam(':email', $email);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

        if ($result_check_email['count'] > 0) {
            // Redirect back to register.php with error message
            header('Location: ../register.php?error=email_taken');
            exit();
        }

        if ($id > 0) {
            // Update query with new fields
            $sql = "UPDATE students SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, birthday = :birthday, middlename = :middlename, suffix = :suffix, address = :address, contact = :contact, image = :image WHERE id = $id;";
        } else {
            // Insert query with new fields
            $sql = "INSERT INTO students (firstname, lastname, email, password, birthday, middlename, suffix, address, contact, image) VALUES (:firstname, :lastname, :email, :password, :birthday, :middlename, :suffix, :address, :contact, :image);";
        }

        $stmt = $pdo->prepare($sql);

        //Binding parameters
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password); //Bind hashed password parameter
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':image', $image_content, PDO::PARAM_LOB); //Bind image content as a binary large object

        //Executing the statement
        $stmt->execute();

        //Get the ID of the inserted record
        $student_id = $pdo->lastInsertId();

        //Set session variables for the newly registered user
        $_SESSION['student_id'] = $student_id;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;

        //Closing connections
        $pdo = null;
        $stmt = null;

        //Redirecting with success message
        header("Location: ../register.php?success");
        exit();
    } catch (PDOException $e) {
        // Handling query error
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Redirecting if accessed directly without POST method
    header('Location: ../register.php');
    exit();
}
?>
