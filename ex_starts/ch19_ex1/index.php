<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/

// Sample data
$cat_id = 1;

// Get the products
$products = get_products_by_category($cat_id);

/***************************************
 * Delete a product
 ****************************************/

// Sample data
$product_name = 'Fender Telecaster';

// Delete the product and display an appropriate messge
// $delete_message = "No rows were deleted.";

$product = get_product_by_name($product_name);
if ($product) {
    $product_id = $product['productID'];
    $row_count = delete_product($product_id);
    if ($row_count > 0) {
        $delete_message = "<B>$row_count</B> row was deleted.";
    } else {
        $delete_message = "No rows were deleted.";
    }
} else {
    $delete_message = "There is no product with that name.";
}

/***************************************
 * Insert a product
 ****************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';

// Insert the data
$product_id = add_product($category_id, $code, $name, $description, $price, 0);

// Display an appropriate message
// $insert_message = "No rows were inserted.";

if ($product_id > 0) {
    $insert_message = "1 row was inserted with this ID: <b>$product_id</b>";
} else {
    $insert_message = "No rows were inserted.";
}

include 'home.php';
?>
