<?php
session_start();
include './models/database.php';
include './models/search_db.php';
unset($_GET['submit']);

$items_found = search_items($_GET['query']);

?>
<!DOCTYPE html>
    <?php include './modules/head.php'; ?>
    <body>
        <?php include './modules/header.php'; ?>
        <main> 
            <div class="container">
                <h2>Search Results</h2>
                <?php // Check if cateogry is empty or null, if so show error that category doesn't exist, otherwise proceed
                    if ($items_found == NULL || $items_found == 0 || $items_found === false): ?>
                    <p class="fs-6 text-center">We were unable to find a product with the search term <?php $_GET['query']; ?></p>
                <?php else: ?>
                    <ul>
                        <!-- display links for all categories -->
                        <?php foreach ($items_found as $item) : ?>
                        <li>
                            <a class="text-body" href="<?php echo
                                'product.php?product_id=' . $item['ItemId']; ?>">
                                <?php echo $item['Name']; ?> <img class="img-fluid rounded product-img" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($item['Img']); ?>" alt="<?php echo $item['Name']; ?>" /> 
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </main>
        <?php include './modules/footer.php'; ?>
    </body>
</html>