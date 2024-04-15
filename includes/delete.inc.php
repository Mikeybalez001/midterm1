<?php

if (isset($_GET['id'])) {
    require_once 'dbc.inc.php';

    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM students WHERE id = :id;";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php?delete");
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    exit();
}
