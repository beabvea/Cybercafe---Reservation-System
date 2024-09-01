<?php
// Include the database connection file
include "../includes/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the reservation ID is provided
  if (isset($_POST["reservation_id"]) && isset($_POST["computer_id"])) {
    $reservationId = $_POST["reservation_id"];
    $computerId = $_POST["computer_id"];
    var_dump($computerId);
    // Delete the reservation from the table
    $sql = "DELETE FROM reservation WHERE reservation_id = $reservationId";
    if ($conn->query($sql) === TRUE) {
      // Update the computer status to "Vacant"
      $sql1 = "UPDATE computers SET comp_desc = 'Vacant' WHERE computer_id = '$computerId'";
      if ($conn->query($sql1) === TRUE) {
        echo "Reservation deleted successfully.";
        header("Location: reserve.php");
        exit();
      } else {
        echo "Error updating computer status: " . $conn->error;
      }
    } else {
      echo "Error deleting reservation: " . $conn->error;
    }
  } else {
    echo "Invalid reservation ID or computer ID.";
  }
} else {
  echo "Invalid request method.";
}
?>
