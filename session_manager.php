<?php
                            session_start();
    if (isset($_SESSION['email'])) {
 
    echo '<a href="' . APP_BASE_URL . '/user_profile.php" class="header-btn"> <i class="uil uil-user-md"></i>Profile</a>';
  } else {

    echo '<a href="' . APP_BASE_URL . '/login.php" class="header-btn"> <i class="uil uil-user-md"></i>Login</a>';
  }
  
?>