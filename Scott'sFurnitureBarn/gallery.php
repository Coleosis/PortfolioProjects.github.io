<?php
session_start();
include './models/database.php';
include './models/categories_db.php';

$categories = get_categories();

function urlize($text)
{
    setlocale(LC_ALL, 'en_US.utf8');
    return strtolower(trim(preg_replace('/[^\\p{L}0-9]+/', '-', str_replace(['\'', '.'], '', iconv('UTF-8', 'ASCII//TRANSLIT', $text))), '-'));
}

?>
<!DOCTYPE html>
    <?php include './modules/head.php'; ?>
    <body>
        <?php include './modules/hero.php'; ?>
        <?php include './modules/header.php'; ?>
        <main> 
            <div class="container text-center">
                
                <h2 class="pt-2">Furniture Categories</h2>
                <div class="row text-center py-3">
                    <?php foreach ($categories as $category) : ?>
                    <?php $image_url = urlize($category['CategoryType']); ?>

                        <div class="col-lg-3 col-6 pb-3">

                            <div class="card pb-0">
                                <a class="text-body text-decoration-none" href="<?php echo 
                                    'category.php?cat_id=' . $category['CategoryId']; ?>">
                                    
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($category['Img']); ?>" alt="<?php echo $category['CategoryType']; ?>" 
                                    class="img-fluid rounded card-img-top CategoryImage">
                                    
                                    <div class="card-footer pt-3">

                                        <p><?php echo $category['CategoryType']; ?></p>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <?php include './modules/footer.php'; ?>
    </body>
    
</html>