<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Dashboard</title>
    <link rel="stylesheet" href="LaundryService.css">
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
            navigator.geolocation.getCurrentPosition(showPosition, errorCallback => {
              console.log(errorCallback);
              x.innerHTML = "Please allow location access";
            }, {
              enableHighAccuracy: true,
              timeout: 5000,
              maximumAge: 0
            });
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        
        var lat = 0;
        var lon = 0;

        function showPosition(position) {
          clearTimeout(setTimeout("geolocFail()", 10000));

          lat = position.coords.latitude;
          lon = position.coords.longitude;
          var api = "1ecf70f59a484579831a92c9331e4e4e";
          
          var requestOptions = {
            method: 'GET',
          };
          
          fetch("https://api.geoapify.com/v1/geocode/reverse?lat=" + lat + "&lon=" + lon + "&apiKey=" + api, requestOptions)
            .then(response => response.json())
            .then((result) => {
              var type = result.features[0].properties.result_type;
              var name = result.features[0].properties.name;
              var street = result.features[0].properties.street;
              // x.innerHTML = lat + ',' + lon + "<br> " + address;
              console.log(lat + ',' + lon);
              if (name == street || name == null) {
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

    <section class="search">
        <div class="container">
          <div class="laundry-info">
            <?php
                $tenant_photo =$_GET['photo'];
                $tenant_name = $_GET['name'];
                $tenant_address = $_GET['address'];
                $tenant_phone = $_GET['phone'];
            ?>
            <img src="<?php echo $tenant_photo ?>" alt="Laundry Image">
            <div class="laundry-details">
              <h2><?php echo $tenant_name ?></h2>
              <p><?php echo $tenant_address ?></p>
              <p><?php echo $tenant_phone ?></p>
            </div>
            </div>
          </div>
        </div>
      </section>
    

    <!-- Cari Laundry -->
        
      <section class="search">
        <div class="container">
          <div class="wash-type">
            <h2>Regular Wash (2-3 days)</h2>
            <div class="prices">
              <?php
                    include "Includes/db.php";
                    $tenant_id = $_GET['id'];

                    $query = "SELECT * FROM laundryservices ls JOIN tenant t ON ls.tenantID = t.id WHERE ls.tenantID = $tenant_id AND ls.serviceCategory = 0";

                    $select_all_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($select_all_query)) {
                      $service_name = $row['serviceName'];
                      $service_price = $row['servicePrice'];
                ?>
                <div class="price">
                  <span><?php echo $service_name?></span>
                <div class="price-laundry">
                  <span><?php echo 'Rp.'. $service_price ?></span>
                </div>
                <div class="quantity">
                  <button class="minus-btn">-</button>
                  <input type="text" value="0" />
                  <button class="plus-btn">+</button>
                </div>
              </div>
              <?php } ?>
              <!-- Add more price elements here -->
            </div>
          </div>
          <div class="wash-type">
            <h2>Express Wash (1 day)</h2>
            <div class="prices">
              <?php
                    include "Includes/db.php";
                    $tenant_id = $_GET['id'];

                    $query = "SELECT * FROM laundryservices ls JOIN tenant t ON ls.tenantID = t.id WHERE ls.tenantID = $tenant_id AND ls.serviceCategory = 1";

                    $select_all_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($select_all_query)) {
                      $service_name = $row['serviceName'];
                      $service_price = $row['servicePrice'];
                ?>
                <div class="price">
                  <span><?php echo $service_name?></span>
                <div class="price-laundry7">
                  <span><?php echo 'Rp.'. $service_price ?></span>
                </div>
                <div class="quantity">
                  <button class="minus-btn">-</button>
                  <input type="text" value="0" />
                  <button class="plus-btn">+</button>
                </div>
              </div>
              <?php } ?>
              <!-- Add more price elements here -->
            </div>
              <!-- Add more price elements here -->
            </div>
          </div>
        </div>
      </section>
      

      <div class="order-list">
        <h2>Order List</h2>
        <ul class="items-list">
          <!-- Selected items will be dynamically added here -->
        </ul>
      </div>
  
      <button id="confirm-btn">Confirm</button>
      

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const minusBtns = document.querySelectorAll('.minus-btn');
          const plusBtns = document.querySelectorAll('.plus-btn');
          const itemsList = document.querySelector('.items-list');
          const confirmBtn = document.getElementById('confirm-btn');

          // Tambahkan event listener untuk tombol minus
          minusBtns.forEach(function(minusBtn) {
            minusBtn.addEventListener('click', function() {
              let quantityInput = this.nextElementSibling;
              let currentValue = parseInt(quantityInput.value);

              if (currentValue !== 0) {
                currentValue--;
                quantityInput.value = currentValue;
                updateOrderList();
              }
            });
          });

          // Tambahkan event listener untuk tombol plus
          plusBtns.forEach(function(plusBtn) {
            plusBtn.addEventListener('click', function() {
              let quantityInput = this.previousElementSibling;
              let currentValue = parseInt(quantityInput.value);

              currentValue++;
              quantityInput.value = currentValue;
              updateOrderList();
            });
          });

          // Update order list
          function updateOrderList() {
            itemsList.innerHTML = ''; // Clear previous items

            // Get all quantity inputs
            const quantityInputs = document.querySelectorAll('.quantity input');

            // Loop through each quantity input
            quantityInputs.forEach(function(quantityInput) {
              let quantityValue = parseInt(quantityInput.value);

              // If quantity is greater than 0, add it to the order list
              if (quantityValue > 0) {
                let serviceName = quantityInput.closest('.price').querySelector('span').innerText;
                let listItem = document.createElement('li');
                listItem.innerText = serviceName + ' : ' + quantityValue;
                listItem.style.marginBottom = '10px'; // Add margin to the list item
                itemsList.appendChild(listItem);
              }
            });
          }

          // Event listener for confirm button
          confirmBtn.addEventListener('click', function() {
          });
        });
      </script>

  </body>
</html>
