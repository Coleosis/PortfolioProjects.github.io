<?php
    // Parse data
    $category_id = $product['CategoryId'];
    $product_name = $product['Name'];
    $product_image = $product['Img'];
    //$product_name = 'Placeholder';  
    $description = $product['Description'];
    $list_price = $product['Price'];
    //$discount_percent = $product['discountPercent'];

    // Add HMTL tags to the description
    $description_tags = add_tags($description);

    // Calculate discounts
    //$discount_amount = round($list_price * ($discount_percent / 100), 2);
    $discount_percent = 0;
    $discount_amount = 0;
    $unit_price = $list_price - $discount_amount;

    // Format discounts
    $discount_percent_f = number_format($discount_percent, 0);
    $discount_amount_f = number_format($discount_amount, 2);
    $unit_price_f = number_format($unit_price, 2);

    // Get image URL and alternate text
    //$image_filename = $product_code . '_m.png';
    //$image_path = $app_path . 'images/' . $image_filename;
    //$image_alt = 'Image filename: ' . $image_filename;
/*Code Reserves 

<div>

    <p><img src="<?php echo $image_path; ?>"
            alt="<?php echo $image_alt; ?>"></p>
            </div>
    <p><b>Discount:</b>
    <?php echo $discount_percent_f . '%'; ?></p>
*/

	
?>
<h1>
    <?php echo $product_name; ?>
</h1>
<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product_image); ?>" /> 
<div>
    <p>
        <b>List Price:</b> <?php echo '$' . $list_price; ?>
    </p>
    <!--<p><b>Discount:</b>
    <?php echo $discount_percent_f . '%'; ?></p>-->
    <p><b>Your Price:</b>
    <?php echo '$' . $unit_price_f; ?>
    (You save <?php echo '$' . $discount_amount_f; ?>)</p>
    <form action="<?php echo $app_path . 'cart' ?>" method="post">
        <input type="hidden" name="action" value="reserve">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="submit" value="Reserve Item">
    </form>
    <h2>Description</h2>
    <?php echo $description_tags; ?>
</div>
