<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item_id"])) {
    $itemIdToRemove = $_POST["item_id"];
    
    // Remove item from session cart
    if (($key = array_search($itemIdToRemove, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
        echo "Item removed successfully";
    } else {
        echo "Item not found in cart";
    }
} else {
    echo "Invalid request";
}
?>