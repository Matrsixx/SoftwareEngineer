<!DOCTYPE html>
<html>
<head>
  <?php 
      include "Includes/db.php";
      session_start(); 
      ob_start();
	?>
	<title>Dry-It! | Profile</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
  <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
	<header>
    <div class="logo">
      <img src="https://cdn.discordapp.com/attachments/524461320314028052/1090298933110124737/logo2.png" alt="Dry-It Logo">
    </div>
    
    <nav>
      <ul>
        <li><a href="Home.php">Home</a></li>
        <li><a href="Transaction.php">Transaction</a></li>
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
              var address = result.features[0].properties.street;
              // x.innerHTML = lat + ',' + lon + "<br> " + address;
              x.innerHTML = address;
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

	<main>
		<section class="profile">
      <div class="profile-main-info">
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture">
        <div class="profile-details">
          <h2><?php echo $_SESSION['username']; ?></h2>
        </div>
        <div class="action-button">
          <a href="UpdateProfile.php" style="text-decoration: none; color: inherit;">
            <button type="submit">Update Profile</button>
            <button type="submit">Change Password</button>
          </a>
        </div>
      </div>
      <div class="profile-secondary-info">
        <div class="profile-email">
          <h2>Email</h2>
          <p><?php echo $_SESSION['email']; ?></p>
        </div>
        <div class="profile-address">
          <h2>Address</h2>
          <p><?php 
            $query = "SELECT address FROM users WHERE id = '".$_SESSION['id']."'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($result);
            echo $row['address'];
          ?></p>
        </div>
      </div>
		</section>
	</main>
</body>
</html>
