<?php
session_start();
include './models/database.php';
include './models/categories_db.php';
include './models/products_db.php';
$cat_id = filter_input(INPUT_GET, 'cat_id', 
FILTER_VALIDATE_INT);
$category = get_category($cat_id);
if($category != NULL || $category != 0 || $category !== false) {
$products = get_items_by_category($category['CategoryId']);
}
?>
<!DOCTYPE html>
    <?php include './modules/head.php'; ?>
    <body>        
        <?php include './modules/hero.php'; ?>
        <?php include './modules/header.php'; ?>
        <main> 
            <div class="container">
                <?php // Check if cateogry is empty or null, if so show error that category doesn't exist, otherwise proceed
                    if ($category == NULL || $category == 0 || $category === false): ?>
                    <div>The category you are looking for does not exist. Please hit the back button in your browser. If you believe this is an error, please contact support.</div>
                    <?php else: ?>
                    <h3><a class="link-dark" href="gallery.php"><p class="py-3 my-0 fs-6 fw-light">Back to Categories</p></a></h3> 
                    <h2 class="text-center">
                        <?php echo $category['CategoryType']; ?>
                    </h2>
                <?php // Check if the category has products. If not, say no products otherwise show them.
                    if (count($products) == 0) : ?>
                    <ul>
                        <li>There are no products in this category.</li>
                    </ul>

                    <?php else: ?>
                    <div class="sorting mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="d-inline-flex justify-content-start my-2 me-4">
                                    <label for="name-sort" class="d-inline me-3">Sort By Name</label>
                                    <select class="name d-inline" id="name-sort">
                                        <option value="1">A-Z</option>
                                        <option value="2">Z-A</option>
                                    </select>
                                </div>
                                <div class="d-inline-flex justify-content-start my-2">
                                <label for="price-sort" class="d-inline me-3">Sort By Price</label>
                                    <select class="price d-inline" id="price-sort">
                                        <option value="1">Low to High</option>
                                        <option value="2">High to Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2 g-4 isotope-grid">
                    <?php foreach ($products as $product) : ?>
                        <div class="col grid-item">                        
                        <div class="card product-card mx-auto col-12 col-sm-12 col-md-8 col-lg-8 my-auto" data-name="<?php echo $product['Name']; ?>" data-price="<?php echo $product['Price']; ?>">                               
                                    <img class="img-fluid ProductImage"  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product['Img']); ?>" alt="<?php echo $product['Name']; ?>" />
                                    <div class="card-body">
                                        <a class="card-title" href="product.php?product_id=<?php
                                                echo $product['ItemId']; ?>">
                                            <?php echo $product['Name']; ?>
                                        </a>
                                        <div>
                                            $<?php echo $product['Price']; ?>    
                                        </div>
                                    </div>
                            </div>                             
                        </div>
                        <?php endforeach; ?>        
                    </div>

                    <?php endif; ?>

                <?php endif; ?>

            </div><br>

        </main>
        <?php include './modules/footer.php'; ?>
        <script type="text/javascript">
            $(document).on("change", ".price", function() 
            {
                var sortingMethod = $(this).val();
            
                if(sortingMethod == '1') {
                    sortProductsPriceAscending();
                } else if (sortingMethod == '2') {
                    sortProductsPriceDescending();
                }
                else
                {
                    $(".isotope-grid").load(location.href+" .isotope-grid>*","");
                }
            });

            $(document).on("change", ".name", function() 
            {
                var sortingMethod = $(this).val();
            
                if(sortingMethod == '1') {
                    sortNameAscending();
                } else if (sortingMethod == '2') {
                    sortNameDescending();
                }
                else
                {
                    $(".isotope-grid").load(location.href+" .isotope-grid>*","");
                }
            });


            function sortProductsPriceAscending() 
            {
                var gridItems = $('.grid-item');
                gridItems.sort(function(a, b) {
                    return $('.product-card', a).data("price") - $('.product-card', b).data("price");
                });

                $(".isotope-grid").append(gridItems);
            }
            function sortNameAscending() 
            {
                var gridItems = $('.grid-item');
                gridItems.sort(function(a, b) {
                    return $('.product-card', a).data("name").toUpperCase().localeCompare($('.product-card', b).data("name").toUpperCase());
                });

                $(".isotope-grid").append(gridItems);
            }

            function sortProductsPriceDescending() 
            {
                var gridItems = $('.grid-item');
                gridItems.sort(function(a, b) {
                    return $('.product-card', b).data("price") - $('.product-card', a).data("price");
                });

                $(".isotope-grid").append(gridItems);
            }

            function sortNameDescending() 
            {
                var gridItems = $('.grid-item');
                gridItems.sort(function(a, b) {
                    return $('.product-card', b).data("name").toUpperCase().localeCompare($('.product-card', a).data("name").toUpperCase());
                });

                $(".isotope-grid").append(gridItems);
            }
        </script>
    </body>
</html>