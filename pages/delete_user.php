<?php

include "../includes/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];

    // Perform the deletion query
    $sql = "DELETE FROM customer WHERE customer_id = $customerId";

    // Run the query
    if ($conn->query($sql) === true) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting entry: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

?>
