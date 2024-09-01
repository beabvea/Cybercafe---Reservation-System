<?php

include "../includes/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $computerId = $_POST['computer-id'];

    // Perform the deletion query
    $sql = "DELETE FROM computers WHERE computer_id = $computerId";

    // Run the query
    if ($conn->query($sql) === true) {
        header("Location: computer.php");
        exit();
    } else {
        echo "Error deleting entry: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

?>
