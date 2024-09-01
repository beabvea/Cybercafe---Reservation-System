<?php

include "../includes/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $computerId = $_POST['editcomputer-id'];
    $computerNumber = $_POST['computer-number'];
    $computerType = $_POST['computer-type'];
    $computerDescription = $_POST['computer-description'];

    // Check if the computer is not vacant
    $sql = "SELECT computer_id FROM computers WHERE comp_desc = 'Occupied' AND computer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $computerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE computers SET comp_number = ?, comp_type = ?, comp_desc = ? WHERE computer_id = ?");

    // Bind parameters to the statement
    $stmt->bind_param("sssi", $computerNumber, $computerType, $computerDescription, $computerId);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: computer.php");
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
