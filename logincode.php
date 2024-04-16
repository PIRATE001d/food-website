<?php
// Database connection
$servername = "localhost";
$username = "pirate001";
$password = "killuagon12";
$database = "deliveryfood"; // Your database name
$admin_table = "adminuser"; // Your admin user table name
$user_table = "regtable"; // Your regular user table name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars($_POST["email"]); // Sanitize email
  $password = htmlspecialchars($_POST["password"]); // Sanitize password

  // Check if user exists in admin user table
  $stmt_admin = $conn->prepare("SELECT Fname FROM $admin_table WHERE email = ? AND Password = ?");
  $stmt_admin->bind_param("ss", $email, $password); // Bind parameters
  $stmt_admin->execute();
  $result_admin = $stmt_admin->get_result();
  $stmt_admin->close(); // Close statement

  // Check if user exists in regular user table if not found in admin user table
  if ($result_admin->num_rows == 1) {
    $row = $result_admin->fetch_assoc();
    $user_name = $row["Fname"]; // Get the user's name

    // Store user data in session variables
    $_SESSION['email'] = $email;
    $_SESSION['user_name'] = $user_name; // Store user's name in session

    // Redirect to admin dashboard
    header("Location: admin/dashboard.php");
    exit();
  } else {
    $stmt_user = $conn->prepare("SELECT Fname FROM $user_table WHERE email = ? AND Password = ?");
    $stmt_user->bind_param("ss", $email, $password); // Bind parameters
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $stmt_user->close(); // Close statement

    if ($result_user->num_rows == 1) {
      $row = $result_user->fetch_assoc();
      $user_name = $row["Fname"]; // Get the user's name

      // Store user data in session variables
      $_SESSION['email'] = $email;
      $_SESSION['user_name'] = $user_name; // Store user's name in session

      // Redirect to user dashboard
      header("Location: menu.php");
      exit();
    } else {
      echo "Invalid email or password!";
    }
  }
}

$conn->close();
?>