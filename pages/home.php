


<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="../css/home.css?v=p<?php echo time(); ?>">
</head>
<style>
  /* Create a grid layout for the boxes */
  .box-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 equal-sized columns */
    grid-gap: 20px; /* Gap between the boxes */
    /* Limit the maximum width of the grid */
    margin: 0 auto; /* Center the grid horizontally */
  }

  .box {
    border: 2px solid #7d12ff; /* Box border */
    padding: 20px; /* Box padding */
    text-align: center; /* Center the content */
    background-color: #f5f5f5; /* Box background color */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Box shadow */
    transition: transform 0.3s ease; /* Transition effect for hover */
    border-radius: 20px;
    margin-top: 45px;
  }

  .box:hover {
    transform: scale(1.05); /* Scale the box on hover */
  }

  .box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
  }
</style>

<body>
  <div id="container">
    <div id="sidebar">
      <h2></h2>
      <ul>
        <li class="menu-item">
          <a href="#" class="active">Home</a>
        </li>
        <li class="menu-item">
          <a href="reserve.php">Reservations</a>
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
      <h1> 𝐿𝒜𝒯𝐸𝒮𝒯 𝒩𝐸𝒲𝒮 </h1>

      <div class="box-container">
        <div class="box">
          <img src="../images/visa.jpg" alt="Image 1">
        </div>
        <div class="box">
          <img src="../images/xiaomail.png" alt="Image 2">
        </div>
        <div class="box">
          <img src="../images/farlight.png" alt="Image 3">
        </div>
      </div>
      <!-- Add your content here -->
    </div>
  </div>
</body>
</html>
