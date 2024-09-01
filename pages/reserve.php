  <?php
  	include "../includes/conn.php";
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Reservations</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css?V=p<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  </head>
  <body>
    <div id="container">
      <div id="sidebar">
        <h2></h2>
        <ul>
          <li class="menu-item">
            <a href="home.php">Home</a>
          </li>
          <li class="menu-item active">
            <a href="#">Reservations</a>
          </li>
          <li class="menu-item">
            <a href="computer.php">Computers</a>
          </li>
          <li class="menu-item">
            <a href="users.php">Users</a>
          </li>
          <li class="menu-item">
            <a href="index.php">Log out</a>
          </li>
        </ul>
      </div>
      <div id="content">

        <h2>Reservations</h2>
          <?php
  // Retrieve reservations from the table
  $sql = "SELECT * FROM reservation";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  ?>
  <table>
    <thead>
      <tr>
        <th>Customer Name</th>
        <th>Computer</th>
        <th>Balance</th>
        <th>Password</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Retrieve reservations with customer names, balance, and password from the tables
        $sql = "SELECT reservation.*, customer.username, customer.balance, customer.password, computers.comp_number
                FROM reservation 
                INNER JOIN customer ON reservation.customer_id = customer.customer_id
                INNER JOIN computers ON reservation.computer_id = computers.computer_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $reservationData = json_encode($row);
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>"; // Display customer name instead of customer_id
            echo "<td>" . $row["comp_number"] . "</td>";
            echo "<td>₱" . $row["balance"] . "</td>"; // Display customer balance
            echo "<td>" . $row["password"] . "</td>"; // Display customer password
            echo "<td class='action-column'>";
            echo "<a href='#' onclick='openUpdateModal(" . $reservationData . ")'><i class='fas fa-edit edit-icon'></i></a>";
           echo "<a href='#' onclick='openDeleteModal(" . $row['reservation_id'] . ", \"" . $row['computer_id'] . "\")'><i class='fas fa-trash-alt delete-icon'></i></a>";
            echo "</td>";
            echo "</tr>";
          }
        } else {
          echo "<p>No reservations found.</p>";
        }
        ?>
      </tbody>
    </table>
    <?php
    } else {  
      echo "<p>No reservations found.</p>";
    }
    ?>

        <!-- Modal Form -->
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Reservation</h2>
            <form action="add_reservation.php" method="POST">
              <label for="customer_id">Customer:</label>
              <select id="customer_id" name="customer_id" required>
                <?php
                // Retrieve customers from the table
                $sql = "SELECT * FROM customer";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['customer_id'] . "'>" . $row['username'] . "</option>";
                  }
                }
                ?>
              </select><br><br>

              <label for="computer_id">Computer:</label>
              <select id="computer_id" name="computer_id" required>
                <?php
                // Retrieve computers from the table
                $sql = "SELECT * FROM computers WHERE comp_desc = 'Vacant'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['computer_id'] . "'>" . $row['comp_number'] . "</option>";
                  }
                }
                ?>
              </select><br><br>

              <input type="submit" value="Add Reservation">
            </form>
          </div>
        </div>

        <!-- Button to Open Modal -->
        <button id="addReservationBtn">Add Reservation</button>
      </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <h2>Update Reservation</h2>
        <!-- Update form fields go here -->
        <form action="update_reservation.php" method="POST">
          <label for="customer_id">Customer:</label>
          <select id="update_customer_id" name="customer_id" required>
            <?php
              // Retrieve customers from the table
              $sql = "SELECT * FROM customer";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['customer_id'] . "'>" . $row['username'] . "</option>";
                }
              }
              ?>
          </select><br><br>

          <label for="computer_id">Computer:</label>
          <select id="update_computer_id" name="computer_id" required>
            <?php
            // Retrieve computers from the table
            $sql = "SELECT * FROM computers WHERE comp_desc = 'Vacant'  ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['computer_id'] . "'>" . $row['comp_number'] . "</option>";
              }
            }
            ?>
          </select><br><br>

          <input type="text" name="edit_reservation_id" id="edit_reservation_id" hidden>
          <input type="text" name="previous_id" id="previous_id" hidden>


          <input type="submit" value="Update Reservation">
        </form>
      </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
      <div class="modal-content">
        <form action="delete_reservation.php" method="POST">
          <span class="close" onclick="closeDeleteModal()">&times;</span>
          <h2>Delete Reservation</h2>
          <p>Are you sure you want to delete this reservation?</p>
          <input type="text" name="reservation_id" id="delete_reservation_id" hidden>
          <input type="text" name="computer_id" id="delete_computer_id" hidden>
          <input type="submit" value="Delete Reservation" onclick="confirmDelete()">
        </form>
      </div>
    </div>

    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("addReservationBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      };

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      };

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };

      // Open the update modal with reservation information
      function openUpdateModal(reservationData) {
        var updateModal = document.getElementById("updateModal");
        updateModal.style.display = "block";

        // Set the values of the update form fields 
        document.getElementById("edit_reservation_id").value = reservationData.reservation_id;
        document.getElementById("update_customer_id").value = reservationData.customer_id;
        document.getElementById("update_computer_id").value = reservationData.computer_id;
        document.getElementById("previous_id").value = reservationData.computer_id;
      }

      // Close the update modal
      function closeUpdateModal() {
        var updateModal = document.getElementById("updateModal");
        updateModal.style.display = "none";
      }

      // Open the delete modal
     function openDeleteModal(reservationId, computerId) {
        console.log("Reservation ID:", reservationId);
        console.log("Computer ID:", computer_id);

        var deleteModal = document.getElementById("deleteModal");
        deleteModal.style.display = "block";

        document.getElementById("delete_reservation_id").value = reservationId;
        document.getElementById("delete_computer_id").value = computerId;
      }
      // Close the delete modal
      function closeDeleteModal() {
        var deleteModal = document.getElementById("deleteModal");
        deleteModal.style.display = "none";
      }

      // Handle delete confirmation
      function confirmDelete() {
        // Add your delete logic here
        console.log("Reservation deleted");
        closeDeleteModal();
      }
    </script>
  </body>
  </html>
