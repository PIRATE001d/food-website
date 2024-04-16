<?php
session_start();


if (!isset($_SESSION['email'])) {
  header("Location: login.php"); 
  exit();
}


$user_email = $_SESSION['email'];
$user_name = $_SESSION['user_name'];


require_once('connection/connect.php');


$password_error = "";
$delete_message = "";


if (isset($_POST['change_password'])) {
  $current_password = htmlspecialchars($_POST['current_password']);
  $new_password = htmlspecialchars($_POST['new_password']);
  $confirm_password = htmlspecialchars($_POST['confirm_password']);

  if (empty($new_password) || strlen($new_password) < 8) {
    $password_error = "New password must be at least 8 characters long.";
  } else if ($new_password !== $confirm_password) {
    $password_error = "New password and confirm password don't match.";
  } else {

    $stmt = $conn->prepare("SELECT Password FROM regtable WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      // Directly compare passwords without hashing
      if ($current_password !== $row['Password']) {
        $password_error = "Current password is incorrect.";
      } else {
        // Update database with new password (replace with your actual query)
        $stmt = $conn->prepare("UPDATE regtable SET Password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $user_email);
        $stmt->execute();
        $stmt->close();

        // Success message
        $password_error = "Password changed successfully!";
      }
    } else {
      $password_error = "Error retrieving user data.";
    }
  }
}


// Handle delete account form submission (if submitted)
if (isset($_POST['delete_account'])) {
  $confirm_delete = htmlspecialchars($_POST['confirm_delete']);

  if ($confirm_delete === "yes") {
    // Delete user account from database (replace with your actual query)
    $stmt = $conn->prepare("DELETE FROM regtable WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $stmt->close();

    // Destroy session and redirect to login
    session_destroy();
    header("Location: login.php");
    exit();
  } else {
    $delete_message = "Confirmation failed. Account not deleted.";
  }
}
if (isset($_POST['update_info'])) {
  $new_address = htmlspecialchars($_POST['new_address']);
  $new_city = htmlspecialchars($_POST['new_city']);

  // Update user address and city in the database (replace with your actual query)
  $stmt = $conn->prepare("UPDATE regtable SET adresse = ?, city = ? WHERE email = ?");
  $stmt->bind_param("sss", $new_address, $new_city, $user_email);
  $stmt->execute();
  if ($stmt->error) {
    echo "Error: " . $stmt->error;
  } else {
    // Success message
    $message = "Address and city updated successfully!";
  }
  $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="css/userstyle.css">
  
</head>
<body>
  


  <h1>Welcome, <?php echo $user_name; ?></h1>

  <p>Your email: <?php echo $user_email; ?></p>

  <h2>Modify Password</h2>
  <?php if (!empty($password_error)) { ?>
    <p class="error"><?php echo $password_error; ?></p> <?php } ?>
  <form action="" method="post">
    <p>
      <label for="current_password">Current Password:</label>
      <input type="password" name="current_password" id="current_password" required>
    </p>
    <p>
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" id="new_password" required>
    </p>
    <p>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" id="confirm_password" required>
    </p>
    <input type="submit" name="change_password" value="Change Password">
  </form>

  <h2>Delete Account</h2>
  <?php if (!empty($delete_message)) { ?>
    <p class="error"><?php echo $delete_message; ?></p> <?php } ?>
  <form action="" method="post">
    <p>
      **Warning:** Deleting your account is permanent. Are you sure you want to delete your account?
    </p>
    <p>
      <label for="confirm_delete">Type "yes" to confirm deletion:</label>
      <input type="text" name="confirm_delete" id="confirm_delete">
    </p>
    <input type="submit" name="delete_account" value="Delete Account">
  </form>

  <!-- Logout button -->
  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="Logout">
  </form>
  <h2>Update Address and City</h2>
  <?php if (!empty($message)) { ?>
    <p class="success"><?php echo $message; ?></p> <?php } ?>
  <form action="" method="post">
    <p>
      <label for="new_address">New Address:</label>
      <input type="text" name="new_address" id="new_address" required>
    </p>
    <p>
      <label for="new_city">New City:</label>
      <input type="text" name="new_city" id="new_city" required>
    </p>
    <input type="submit" name="update_info" value="Update Address and City">
  </form>
</body>
</html>
