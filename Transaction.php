<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Transaction</title>
    <link rel="stylesheet" href="Transaction.css">
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

    <div class="tab">
      <button class="tablinks" id="lefttab" onclick="openTab(event, 'tab1')"><h3>Ongoing Transaction</h3></button>
      <button class="tablinks" id="righttab" onclick="openTab(event, 'tab2')"><h3>Past Transaction</h3></button>

      <div id="tab1" class="tabcontent">
        <div>
          <?php
              include "Includes/db.php";

              session_start();
              $id = $_SESSION['id'];
              $query = "SELECT * FROM transactionheader JOIN tenant ON transactionheader.TenantId = tenant.id JOIN users ON transactionheader.usersid = users.id WHERE transactionheader.TransactionProgress = 0 AND transactionheader.usersid = $id;";

              $select_all_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_all_query)){
                $tenant_name = $row['name'];
                $tenant_address = $row['address'];
                $tenant_photo = $row['Photo'];
                $tenant_phone = $row['phone'];
                $transaction_date = $row['TransactionDate'];
                $transaction_progress = $row['TransactionProgress'];
                $transaction_price = $row['TransactionPrice'];
            ?>
            <div class="laundry container">
              <div class="leftcolumn">
                <img src="<?php echo $tenant_photo ?>" alt="Laundry 1">
              </div>
              <div class="middlecolumn">
                <div class="info">
                  <h3><?php echo $tenant_name ?></h3>
                  <p><?php echo $tenant_address ?></p>
                  <p><?php echo $tenant_phone ?></p>
                </div>
              </div>
              <div class="rightcolumn">
                <div class="info">
                  <p><?php 
                  $date = strtotime($transaction_date);
                  echo date("d - m - Y", $date);
                  ?></p>
                  <p><?php 
                    if ($transaction_progress == 0) {
                      echo "On Progress";
                    }
                  ?></p>
                  <p><?php echo 'Rp ', $transaction_price?></p>
                </div>
              </div>
            </div>

            <?php } ?>
        </div>
      </div>

      <div id="tab2" class="tabcontent">
      <div>
          <?php
              include "Includes/db.php";

              $id = $_SESSION['id'];
              $query = "SELECT * FROM transactionheader JOIN tenant ON transactionheader.TenantId = tenant.id JOIN users ON transactionheader.usersid = users.id WHERE transactionheader.TransactionProgress = 1 AND transactionheader.usersid = $id;";

              $select_all_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_all_query)){
                $tenant_name = $row['name'];
                $tenant_address = $row['address'];
                $tenant_photo = $row['Photo'];
                $tenant_phone = $row['phone'];
                $transaction_date = $row['TransactionDate'];
                $transaction_progress = $row['TransactionProgress'];
                $transaction_price = $row['TransactionPrice'];
            ?>
            <div class="laundry container">
              <div class="leftcolumn">
                <img src="<?php echo $tenant_photo ?>" alt="Laundry 1">
              </div>
              <div class="middlecolumn">
                <div class="info">
                  <h3><?php echo $tenant_name ?></h3>
                    <p><?php echo $tenant_address ?></p>
                    <p><?php echo $tenant_phone ?></p>
                </div>
              </div>
              <div class="rightcolumn">
                <div class="info">
                  <p><?php 
                  $date = strtotime($transaction_date);
                  echo date("d - m - Y", $date);
                  ?></p>
                  <p><?php 
                    if ($transaction_progress == 1) {
                      echo "Order Completed";
                    }
                  ?></p>
                  <p><?php echo 'Rp ', $transaction_price?></p>
                </div>
              </div>
            </div>

            <?php } ?>
        </div>
      </div>
    </div>

</body>

  <script>
    // Function to open the default tab and set it as active
    function openDefaultTab() {
      document.getElementById("lefttab").click(); // Simulate a click on the left tab
    }

    // Function to handle tab switching
    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Open the default tab when the page loads
    document.addEventListener("DOMContentLoaded", openDefaultTab);
  </script>

</html>