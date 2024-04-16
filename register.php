<?php require_once('./config.php'); ?>
<!DOCTYPE html>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="./css/style-reg.css" />
  </head>
  <body>
    <section class="container">
      <header>Registration</header>
      <form action="/register.php" method="POST" class="form" name="register">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" name="Fname" placeholder="Enter full name" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" name="gemail" placeholder="Enter email address" required />
        </div>
        <div class="input-box">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter Password" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="text" name="tele" placeholder="Enter phone number" required />
          </div>
        
        </div>
     
        <button type="submit" name="Submit" >Submit</button>
        <div class="alreadyacc">
          <a href="/login.php	">already having Account?</a>
        </div>
        
      </form>
    </section>
  </body>
</html>

<?php
// Database connection
$servername = "localhost";
$username = "pirate001";
$password = "killuagon12";
$database = "deliveryfood"; // Your database name
$table = "regtable"; // Your table name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from registration form
if (isset($_POST["Fname"]) && isset($_POST["gemail"]) && isset($_POST["password"]) && isset($_POST["tele"])) {

    $Fname = $_POST["Fname"];
    $email = $_POST["gemail"];
    $password = $_POST["password"]; // Get the password from the form

    // Check if email already exists using prepared statement
    $stmt_check_email = $conn->prepare("SELECT * FROM $table WHERE email=?");
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    $stmt_check_email->close();

    if ($result_check_email->num_rows > 0) {
        echo "Email already exists!";
        exit;
    }

    $tele = $_POST["tele"];

    // Insert user into database (use plain text password) using prepared statement
    $stmt_insert_user = $conn->prepare("INSERT INTO $table (Fname, email, Password, tele) VALUES (?, ?, ?, ?)");
    $stmt_insert_user->bind_param("ssss", $Fname, $email, $password, $tele);
    if ($stmt_insert_user->execute()) {
        echo "Registration successful!";
        $stmt_insert_user->close();
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
  echo 'rah mkhdamch';
}

$conn->close();
