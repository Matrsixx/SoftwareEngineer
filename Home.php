<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Dashboard</title>
    <link rel="stylesheet" href="Home.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="logo">
        <img src="https://cdn.discordapp.com/attachments/524461320314028052/1090298933110124737/logo2.png" alt="Dry-It Logo">
      </div>
      
      <nav>
        <ul>
          <li><a href="Home.php">Home</a></li>
          <li><a href="#">History</a></li>
          <li class="profile">
            <a href="#">Profile</a>
            <ul>
              <li><a href="profile.php">View Profile</a></li>
              <li><a href="index.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      
      <div class="location">
        <p>Lokasi Anda:</p>
        <button class="btn-location" window.onload=function(){getLocation();} id="location"></button>

        <script>
        var x = document.getElementById("location");

        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }

        function showPosition(position) {
          x.innerHTML = "Latitude: " + position.coords.latitude + 
          "<br>Longitude: " + position.coords.longitude;
        }
        </script>
      </div>
    </header>

    <!-- Cari Laundry -->
    <section class="search">
      <div class="container">
        <h2>Cari Laundry</h2>
        <form>
          <input type="text" placeholder="Masukkan nama laundry">
          <button>Cari</button>
        </form>
      </div>
    </section>

    <!-- Laundry Terdekat -->
    <section class="nearby">
      <div class="container">
        <h2>Laundry Terdekat</h2>
        <div class="laundries">
          <?php
            include "Includes/db.php";
            $query = "SELECT * FROM tenant";

            $select_all_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_query)){
              $tenant_name = $row['name'];
              $tenant_address = $row['address'];
              $tenant_photo = $row['Photo'];
          ?>
          <div class="laundry">
            <img src="<?php echo $tenant_photo ?>" alt="Laundry 1">
            <h3><?php echo $tenant_name ?></h3>
            <p><?php echo $tenant_address ?></p>
          </div>

          <?php } ?>
        </div>
      </div>
    </section>

  </body>
</html>
