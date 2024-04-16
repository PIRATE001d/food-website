<?php require_once('./config.php'); ?>
<?php global $currentPage; ?>

<?php

$servername = "localhost";
$username = "pirate001";
$password = "killuagon12";
$database = "deliveryfood"; // Your database name
$table = "menu_items"; // Your table name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$maxItemsInCart = 5; 


// Check if the form has been submitted



// Initialize total price variable
$total_price = 0;



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/stylecart.css">
</head>
<body>
    

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card shopping-cart" style="border-radius: 15px;">
          <div class="card-body text-black">

            <div class="row">
            <div class="row">
    <div class="col-lg-6 px-5 py-4">
      <div class="headeritem"></div>
        <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>
        <?php
        // Check if the cart is not empty
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through each item in the cart
            foreach($_SESSION['cart'] as $item_id) {
                // Fetch item details from the database based on item ID
                $sql = "SELECT * FROM menu_items WHERE id = $item_id"; // Replace menu_items with your actual table name
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Fetch item details
                    $row = $result->fetch_assoc();
                    $item_name = $row['name']; // Assuming 'name' is the column name for item name
                    $item_price = $row['price']; // Assuming 'price' is the column name for item price
                    $item_description = $row['description'];
                    $item_image = $row['image'] // Assuming 'image' is the column name for item image URL
        ?>
                    <div class="d-flex align-items-center mb-5">
                        <div class="flex-shrink-0">
                            <img src="<?php echo $item_image; ?>" class="img-fluid" style="width: 150px;" alt="Product Image">
                        </div>
                        <div class="flex-grow-1 ms-3">
        
                            <h5 class="text-primary"><?php echo $item_name; ?></h5>
                            
                            <h6 style="color: #9e9e9e;">Description: <?php echo $item_description ?> </h6>
                            
                            <div class="d-flex align-items-center">
                                <p class="fw-bold mb-0 me-5 pe-3"><?php echo $item_price; ?>$</p>
                                
                                <div class="def-number-input number-input safari_only">
                                    <button onclick="decrementQuantity(this)" class="minus"></button>
                                    <!-- Assuming you have a PHP loop that generates the HTML for each item in the cart -->
<?php foreach($_SESSION['cart'] as $item_id) : ?>
    <?php

    $sql = "SELECT price FROM menu_items WHERE id = $item_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_price = $row['price'];
    } else {
        // Handle the case where item details are not found
        $item_price = 0; // or some default price
    }
    ?>
    <!-- Output the HTML for the item with the correct data-price attribute -->
    <input class="quantity fw-bold text-black" min="0" name="quantity" type="number" value="1" onchange="updateTotalPrice(this)" data-price="<?php echo $item_price; ?>">
    <?php break; // Stop the loop after generating one input ?>
<?php endforeach; ?>
                                    <button onclick="incrementQuantity(this)" class="plus"></button>
                                    

                                </div>
                            </div>
                            <button onclick="removeItem(<?php echo $item_id; ?>)" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #FFD43B;"></i> Remove</button>
</div>
</div>
<script>
  function removeItem(itemId) {
    // AJAX call to remove item from session cart
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Reload the page after successful removal
          window.location.reload();
        } else {
          console.error('Error removing item from cart');
        }
      }
    };
    xhr.open('POST', 'remove_item.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('item_id=' + itemId);
  }
</script>
        <?php
                }
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
</div>
                      
                     
                    </div>
                  </div>
                </div>

 

                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">

                <div class="d-flex justify-content-between px-x">
                  <p class="fw-bold">Delivery Guy:</p>
                  <p class="fw-bold">5$</p>
                </div>
                <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                
                  <h5 class="fw-bold mb-0"></h5>
                  <h5 id="total-price" class="fw-bold mb-0"><?php echo $total_price; ?></h5>
                </div>

              </div>
              <div class="col-lg-6 px-5 py-4">

                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment</h3>

                <form class="mb-5">

                  <div data-mdb-input-init class="form-outline mb-5">
                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                      placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                    <label class="form-label" for="typeText">Card Number</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-5">
                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                      placeholder="your card name" />
                    <label class="form-label" for="typeName">Name on card</label>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-5">
                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="01/22"
                          size="7" id="exp" minlength="7" maxlength="7" />
                        <label class="form-label" for="typeExp">Expiration</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-5">
                      <div data-mdb-input-init class="form-outline">
                        <input type="password" id="typeText" class="form-control form-control-lg"
                          placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                        <label class="form-label" for="typeText">Cvv</label>
                      </div>
                    </div>
                  </div>

                 

                  <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg">Buy now</button>

                  <h5 class="fw-bold mb-5" style="position: absolute; bottom: 0;">
                    <a href="<?php echo APP_BASE_URL;?>/menu.php"><i class="fas fa-angle-left me-2"></i>Back to shopping</a>
                  </h5>

                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
</body>
</html>


<script>
    // Function to calculate total price of items in the cart
    function calculateTotalPrice() {
        var totalPrice = 0;
        var quantityInputs = document.querySelectorAll('.quantity');

        quantityInputs.forEach(function(input) {
            var quantity = parseInt(input.value);
            var itemPrice = parseFloat(input.dataset.price); // Retrieve item price from data attribute
            totalPrice += quantity * itemPrice;
        });

        return totalPrice.toFixed(2);
    }

    // Function to increment quantity
    function incrementQuantity(input) {
        var inputElement = input.parentNode.querySelector('input[type=number]');
        inputElement.stepUp();
        updateTotalPrice();
        // Save quantity to local storage
        localStorage.setItem('quantity', inputElement.value);
    }

    // Function to decrement quantity
    function decrementQuantity(input) {
        var inputElement = input.parentNode.querySelector('input[type=number]');
        if (inputElement.value > 0) {
            inputElement.stepDown();
            updateTotalPrice();
            // Save quantity to local storage
            localStorage.setItem('quantity', inputElement.value);
        }
    }

    // Function to update total price
    function updateTotalPrice() {
        var totalPrice = calculateTotalPrice();
        document.getElementById('total-price').innerText = totalPrice;
    }

    // Retrieve quantity value from local storage and set it as the initial value
    document.addEventListener('DOMContentLoaded', function() {
        var quantityInputs = document.querySelectorAll('.quantity');
        var storedQuantity = localStorage.getItem('quantity');
        if (storedQuantity !== null) {
            quantityInputs.forEach(function(input) {
                input.value = storedQuantity;
            });
        }
        updateTotalPrice();
    });
</script>






