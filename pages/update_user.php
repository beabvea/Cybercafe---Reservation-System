<?php

include "../includes/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['editcustomer_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $balance = $_POST['balance'];
    $birthdate = $_POST['birthdate'];
    $contactNumber = $_POST['contact-number'];

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE customer SET username = ?, password = ?, balance = ?, birthdate = ?, contact_number = ? WHERE customer_id = ?");

    // Bind parameters to the statement
    $stmt->bind_param("ssdssi", $username, $password, $balance, $birthdate, $contactNumber, $customerId);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error updating entry: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

?>
