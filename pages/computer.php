<?php
	include '../includes/conn.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Computers</title>
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
          <a href="users.php">Users</a>
        </li>
        <li class="menu-item">
          <a href="index.php">Log out</a>
        </li>
      </ul>
    </div>
    <div id="content">

      <h2>Computer List</h2>
        <?php
        // Retrieve users from the table
        $sql = "SELECT * FROM computers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          ?>
          <table>
            <thead>
              <tr>
                <th>Computer Number</th>
                <th>Computer type</th>
                <th>Computer Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                $computerData = json_encode($row);
                echo "<tr>";
                echo "<td>" . $row["comp_number"] . "</td>";
                echo "<td>" . $row["comp_type"] . "</td>";
                echo "<td>" . $row["comp_desc"] . "</td>";
                echo "<td class='action-column'>";
                echo "<a href='#' onclick='openUpdateModal(" . $computerData . ")'><i class='fas fa-edit edit-icon'></i></a>";
                echo "<a href='#' onclick='openDeleteModal(". $row['computer_id']. ")'><i class='fas fa-trash-alt delete-icon'></i></a>";
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
		    <form action="add_computer.php" method="POST">
		      <label for="username">Computer Number:</label>
		      <input type="number" name="computer-number" required><br><br>

		      <label for="password">Computer Type:</label>
		      <select name="computer-type" required>
		        <option value="VIP">VIP</option>
		        <option value="Regular">Regular</option>
		      </select><br><br>

		      <label for="balance">Computer Description:</label>
          <input type="text" id="computer-description" name="computer-description" value="Vacant" readonly><br><br>

		      <input type="submit" value="Add Computer">
		    </form>
		  </div>
		</div>

      <!-- Button to Open Modal -->
      <button id="addUserBtn">Add Computer</button>
    </div>
  </div>

  <!-- Update Modal -->
  <div id="updateModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeUpdateModal()">&times;</span>
      <h2>Update User</h2>
      <!-- Update form fields go here -->
      <form action="update_computer.php" method="POST">
        <!-- Add your update form fields here -->
        <label for="username">Computer Number:</label>
          <input type="text" name="editcomputer-id" id="editcomputer-id" hidden>
          <input type="text" id="computer-number" name="computer-number" required><br><br>

          <label for="password">Computer Type:</label>
		      <select name="computer-type" id="computer-type" required>
		        <option value="VIP">VIP</option>
		        <option value="Regular">Regular</option>
		      </select><br><br>

          <label for="computer-description">Computer Desc:</label>
          <select name="computer-description" id="computer-description" required>
            <option value="Vacant">Vacant</option>
            <option value="Reserved">Reserved</option>
            <option value="Under maintenance">Under Maintenance</option>
          </select><br><br>

        <input type="submit" value="Update Computer">
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <form action="delete_computer.php" method="POST">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Delete Computer</h2>
        <p>Are you sure you want to delete this computer?</p>
        <input type="text" name="computer-id" id="deletecomputer-id" hidden>
        <input type="submit" value="Delete Computer" onclick="confirmDelete()">
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
    function openUpdateModal(computerData) {
      var updateModal = document.getElementById("updateModal");
      updateModal.style.display = "block";

      // Set the values of the update form fields 
      document.getElementById("editcomputer-id").value = computerData.computer_id;
      document.getElementById("computer-number").value = computerData.comp_number;
      document.getElementById("computer-type").value = computerData.comp_type;
      document.getElementById("computer-description").value = computerData.comp_desc;
    }

    // Close the update modal
    function closeUpdateModal() {
      var updateModal = document.getElementById("updateModal");
      updateModal.style.display = "none";
    }

    // Open the delete modal
    function openDeleteModal(computerId) {
      var deleteModal = document.getElementById("deleteModal");
      deleteModal.style.display = "block";

      document.getElementById("deletecomputer-id").value = computerId;
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
?>