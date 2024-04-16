




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Swiper Slider CSS -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Fancy Box CSS -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Menu Style CSS -->
    <link rel="stylesheet" href="css/menustyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="body-fixed">

<?php include './header.php'; ?>

<section class="main-content">
    <div class="container">
        <div class="row">
        <?php
// Start the session to access session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection file
$servername = "localhost";
$username = "pirate001";
$password = "killuagon12";
$database = "deliveryfood"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted and an item ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    // Initialize the cart session variable if not already initialized
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Add the item ID to the cart session array
    $_SESSION['cart'][] = $_POST['item_id'];
}

// Fetch menu items from the database
$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

// Check if there are any menu items
if ($result->num_rows > 0) {
    // Loop through each menu item
    while($row = $result->fetch_assoc()) {
?>
                    <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="food-card">
                <div class="food-card_img">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <a href="#!"><i class="far fa-heart"></i></a>
                </div>
                <div class="food-card_content">
                    <div class="food-card_title-section">
                        <a href="#!" class="food-card_title"><?php echo $row['name']; ?></a>
                        <a href="#!" class="food-card_author"><?php echo $row['type']; ?></a>
                    </div>
                    <div class="food-card_bottom-section">
                        <div class="space-between">
                            <div>
                                <span class="fa fa-fire"></span> <?php echo $row['description']; ?> description
                            </div>
                            <div class="pull-right">
                                <span class="badge badge-success"><?php echo $row['type']; ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="space-between">
                            <div class="food-card_price">
                                <span><?php echo $row['price']; ?>$</span>
                            </div>
                            <form action="" method="post">
                                <!-- Add to cart button -->
                                <button class="addtocart" type="submit" name="item_id" value="<?php echo $row['id']; ?>">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "No menu items found.";
}
// Close database connection
$conn->close();
?>
        </div>
    </div>
</section>

  <!-- footer starts  -->
  <footer class="site-footer" id="contact">
                <div class="top-footer section">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="footer-info">
                                        <div class="footer-logo">
                                            <a href="index.html">
                                                <img src="logo.png" alt="">
                                            </a>
                                        </div>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia, tenetur.
                                        </p>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-github-alt"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-youtube"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-flex-box">
                                        
                                        <div class="footer-menu food-nav-menu">
                                            <h3 class="h3-title">Links</h3>
                                            <ul class="column-2">
                                                <li>
                                                    <a href="#home" class="footer-active-menu">Home</a>
                                                </li>
                                                <li><a href="#about">About</a></li>
                                                <li><a href="#menu">Menu</a></li>
                                                <li><a href="#gallery">Gallery</a></li>
                                                <li><a href="#blog">Blog</a></li>
                                                <li><a href="#contact">Contact</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu">
                                            <h3 class="h3-title">Company</h3>
                                            <ul>
                                                <li><a href="#">Terms & Conditions</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Cookie Policy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="copyright-text">
                                    <p>Copyright &copy; 2024 <span class="name">PIRATE.</span>All Rights Reserved.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="scrolltop"><i class="uil uil-angle-up"></i></button>
                    </div>
                </div>
            </footer>

</body>
</html>
<script>
    const button = document.querySelector(".addtocart");
    const done = document.querySelector(".done");
    let added = false;

    button.addEventListener('click', () => {
        if (!added) {
            done.style.transform = "translate(0px)";
            added = true;

            // Automatically reset the transformation after 2 seconds (adjust as needed)
            setTimeout(() => {
                done.style.transform = "translate(-110%) skew(-40deg)";
                added = false;
            }, 1000); // 2000 milliseconds = 2 seconds
        }
    });
</script>