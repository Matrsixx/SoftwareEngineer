<!DOCTYPE html>
<html>
<head>
  <?php 
      include "Includes/db.php";
      session_start(); 
      ob_start();
	?>
	<title>Halaman Pembayaran</title>
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
        <li><a href="#">Transaction</a></li>
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
      <button class="btn-location">Jl. Sudirman No. 5</button>
    </div>
  </header>

	<main>
		<section class="profile">
      <div class="profile-main-info">
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture">
        <div class="profile-details">
          <h2><?php echo $_SESSION['username']; ?></h2>
          <p>Change Profile Picture</p>
          <p>Remove Profile Picture</p>
        </div>
        <div class="action-button">
          <button type="submit">Edit Profile</button>
          <button type="submit">Change Password</button>
        </div>
      </div>
      <div class="profile-secondary-info">
        <div class="profile-email">
          <h2>Email</h2>
          <p><?php echo $_SESSION['email']; ?></p>
        </div>
        <div class="profile-address">
          <h2>Address</h2>
          <p>User's Address</p>
        </div>
      </div>
		</section>
	</main>
</body>
</html>
