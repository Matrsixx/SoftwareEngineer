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
          <li><a href="./Transaction.php">Transaction</a></li>
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

        <button class="btn-location" id="location"></button>
      
        <script>
        var x = document.getElementById("location");

        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        
        var lat = 0;
        var lon = 0;

        function showPosition(position) {
          lat = position.coords.latitude;
          lon = position.coords.longitude;
          var api = "1ecf70f59a484579831a92c9331e4e4e";
          
          var requestOptions = {
            method: 'GET',
          };

          fetch("https://api.geoapify.com/v1/geocode/reverse?lat=" + lat + "&lon=" + lon + "&apiKey=" + api, requestOptions)
            .then(response => response.json())
            .then((result) => {
              var name = result.features[0].properties.name;
              var street = result.features[0].properties.street;
              // x.innerHTML = lat + ',' + lon + "<br> " + address;
              if (name == street) {
                x.innerHTML = street;
              } else {
                x.innerHTML = name + "<br>" + street;
              }
              
            })
            .catch(error => {
              console.log('error', error);
              x.innerHTML = "Geolocation is not supported by this browser.";
            });
          
        }

        window.onload = function() {
          getLocation();
        };
        </script>

      </div>
    </header>

    <?php
      $search = '%';
      include "Includes/db.php";
    ?>
        
    <!-- Cari Laundry -->
    <section class="search">
      <div class="container">
        <h2>Cari Laundry</h2>
        <form action = "Home.php" method="GET">
          <input type="text" id="name" name="name" placeholder="Masukkan nama laundry">
          <button>Cari</button>

          <?php
            if (isset($_GET['name'])) {
              $name = $_GET['name'];
              $search = '%' . $name . '%';
            }
          ?>

        </form>
      </div>
    </section>

    <!-- Laundry Terdekat -->
    <section class="nearby">
      <div class="container">
        <h2>Laundry Terdekat</h2>
        <div class="laundries">
          <?php
            $query = "SELECT * FROM tenant WHERE name LIKE '$search'";

            $select_all_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_query)){
              $tenant_name = $row['name'];
              $tenant_address = $row['address'];
              $tenant_photo = $row['Photo'];
              $tenant_phone = $row['phone'];
          ?>
          <div class="laundry">
            <a href="LaundryService.php?name=<?php echo urlencode($tenant_name) ?>&address=<?php echo urlencode($tenant_address) ?>&photo=<?php echo urlencode($tenant_photo) ?>&phone=<?php echo urlencode($tenant_phone) ?>" style="text-decoration: none; color: inherit;">
              <img src="<?php echo $tenant_photo ?>" alt="Laundry Image">
              <h3><?php echo $tenant_name ?></h3>
              <p><?php echo $tenant_address ?></p>
            </a>
          </div>

          <?php } ?>
        </div>
      </div>
    </section>

  </body>
</html>
