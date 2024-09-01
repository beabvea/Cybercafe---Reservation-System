<?php
	include "../includes/conn.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
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
        <li class="menu-item">
          <a href="reserve.php">Reservations</a>
        </li>
        <li class="menu-item">
          <a href="computer.php">Computers</a>
        </li>
        <li class="menu-item" class="active">
          <a href="#">Users</a>
        </li>
        <li class="menu-item">
          <a href="index.php">Log out</a>
        </li>
      </ul>
    </div>
    <div id="content">


      <h2>           </h2>
      
        <?php
        // Retrieve users from the table
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          ?>
          <table>
            <thead>
              <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Balance</th>
                <th>Birthdate</th>
                <th>Contact Number</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                $customerData = json_encode($row);
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>₱" . $row["balance"] . "</td>";
                echo "<td>" . $row["birthdate"] . "</td>";
                echo "<td>" . $row["contact_number"] . "</td>";
                echo "<td class='action-column'>";
                echo "<a href='#' onclick='openUpdateModal(" . $customerData . ")'><i class='fas fa-edit edit-icon'></i></a>";
                echo "<a href='#' onclick='openDeleteModal(". $row['customer_id']. ")'><i class='fas fa-trash-alt delete-icon'></i></a>";
                echo "</td>";
                echo "</tr>";
              }
              ?>
                </tbody>
              </table>
              <?php
            } else {
              echo "<p>No users found.</p>";
            }
            ?>
            <!-- Modal Form -->
      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Add User</h2>
          <form action="add_user.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <label for="balance">Balance:</label>
            <input type="number" name="balance" required><br><br>

            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" required><br><br>

            <label for="contact-number">Contact Number:</label>
            <input type="text" name="contact-number" required><br><br>

            <input type="submit" value="Add User">
          </form>
        </div>
      </div>

      <!-- Button to Open Modal -->
      <button id="addUserBtn">Add User</button>
    </div>
  </div>

  <!-- Update Modal -->
  <div id="updateModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeUpdateModal()">&times;</span>
      <h2>Update User</h2>
      <!-- Update form fields go here -->
      <form action="update_user.php" method="POST">
        <!-- Add your update form fields here -->
        <label for="username">Username:</label>
          <input type="text" name="editcustomer_id" id="editcustomer_id" hidden>
          <input type="text" id="username" name="username" required><br><br>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required><br><br>

          <label for="balance">Balance:</label>
          <input type="number" id="balance" name="balance" required><br><br>

          <label for="birthdate">Birthdate:</label>
          <input type="date" id="birthdate" name="birthdate" required><br><br>

          <label for="contact-number">Contact Number:</label>
          <input type="text" id="contact-number" name="contact-number" required><br><br>
        <input type="submit" value="Update User">
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <form action="delete_user.php" method="POST">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Delete User</h2>
        <p>Are you sure you want to delete this user?</p>
        <input type="text" name="customer_id" id="deletecustomer_id" hidden>
        <input type="submit" value="Delete User" onclick="confirmDelete()">
      </form>
    </div>
  </div>

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addUserBtn");

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

    // Open the update modal with customer information
    function openUpdateModal(customerData) {
      var updateModal = document.getElementById("updateModal");
      updateModal.style.display = "block";

      // Set the values of the update form fields 
      document.getElementById("editcustomer_id").value = customerData.customer_id;
      document.getElementById("username").value = customerData.username;
      document.getElementById("password").value = customerData.password;
      document.getElementById("balance").value = customerData.balance;
      document.getElementById("birthdate").value = customerData.birthdate;
      document.getElementById("contact-number").value = customerData.contact_number;
    }

    // Close the update modal
    function closeUpdateModal() {
      var updateModal = document.getElementById("updateModal");
      updateModal.style.display = "none";
    }

    // Open the delete modal
    function openDeleteModal(userId) {
      var deleteModal = document.getElementById("deleteModal");
      deleteModal.style.display = "block";

      document.getElementById("deletecustomer_id").value = userId;
    }

    // Close the delete modal
    function closeDeleteModal() {
      var deleteModal = document.getElementById("deleteModal");
      deleteModal.style.display = "none";
    }

    // Handle delete confirmation
    function confirmDelete() {
      // Add your delete logic here
      console.log("User deleted");
      closeDeleteModal();
    }
  </script>
</body>
</html>
