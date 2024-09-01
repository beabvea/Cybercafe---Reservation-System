<?php
include "../includes/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $customerId = $_POST["customer_id"];
  $computerId = $_POST['computer_id'];

  // Insert reservation into the database
  $sql = "INSERT INTO reservation (reservation_id, customer_id, computer_id) VALUES (NULL, $customerId, $computerId)";

  if ($conn->query($sql) === TRUE) {
    // Reservation added successfully
    $sql1 = "UPDATE computers SET comp_desc = 'Occupied' WHERE computer_id = '$computerId'";

    if ($conn->query($sql1) === TRUE) {
      header("Location: reserve.php");
      exit();
    }
    
  } else {
    // Error occurred while adding reservation
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
