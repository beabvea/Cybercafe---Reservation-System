<?php
include "../includes/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $reservationId = $_POST["edit_reservation_id"];
  $customerId = $_POST["customer_id"];
  $computerId = $_POST['computer_id'];
  $previousId = $_POST['previous_id'];

  // Update reservation in the database
  $sql = "UPDATE reservation SET customer_id = $customerId, computer_id = $computerId WHERE reservation_id = $reservationId";

  if ($conn->query($sql) === TRUE) {
    // Reservation updated successfully
    $sql1 = "UPDATE computers SET comp_desc = 'Vacant' WHERE computer_id = '$previousId'";
    $sql2 = "UPDATE computers SET comp_desc = 'Occupied' WHERE computer_id = '$computerId'";
    if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
      header("Location: reserve.php");
      exit();
     }
  } else {
    // Error occurred while updating reservation
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
