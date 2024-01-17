 <?php 
include './models/database.php';

function getFeaturedItems($limit = 4) {
    global $db;
    try{

        $query = "SELECT * FROM items WHERE `featured` = 'yes' ORDER BY RAND() LIMIT :limit";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    } catch(PDOException $e) {
        display_db_error($e->getMessage());
    }
}

$perfectConditionItems = getFeaturedItems($limit = 4);
?> 

<div class="container">
    <h2 class="text-center pt-2">
        <?php if ($perfectConditionItems == NULL) {
        echo 'There are currently no featured items <br> Please check the Gallery for current furniture';}
        else 
            echo 'Featured Items'    
        ?>
    </h2>
    <div class="container-fluid" id="mobileCarousel"> 
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($perfectConditionItems as $key => $item) : ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" <?= $key == 0 ? 'class="active"' : '' ?> aria-label="Slide <?= $key + 1 ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($perfectConditionItems as $key => $item) : ?>
                    <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                        <?php 
                            $imgData = base64_encode($item['Img']);
                            $imgSrc = "data:image/jpeg;base64,{$imgData}";
                        ?>
                        <img src="<?= $imgSrc ?>" class="d-block w-100 img-fluid rounded" style="width: 8vw; height: 35vw;" alt="<?= $item['Name'] ?>">

                        <a href="product.php?product_id=<?= $item['ItemId'] ?>" class="link-dark link-underline link-underline-opacity-0">
                            <div class="card-footer text-center pt-2">
                                <small class="text-muted">Reserve now</small>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-fluid" id="desktopCards">
        <div class="row py-3 g-3">
            <?php foreach ($perfectConditionItems as $item) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 mb-0">
                        <?php 
                            $imgData = base64_encode($item['Img']);
                            $imgSrc = "data:image/jpeg;base64,{$imgData}";
                        ?>
                        
                        <a href="product.php?product_id=<?= $item['ItemId'] ?>" class="link-dark link-underline link-underline-opacity-0">
                            <img src="<?= $imgSrc ?>" class="img-fluid rounded card-img-top mx-auto d-block pb-1" alt="<?= $item['Name'] ?>" style="width: 16vw; height: 10vw;">

                            <div class="card-body h-25 mb-4">
                                <h6 class="card-title text-center"><?= $item['Name'] ?></h6>
                                <p class="card-text text-center">$<?= number_format($item['Price'], 2) ?></p>
                            </div>

                            <div class="text-center">
                                <small class="text-muted">Reserve Now</small>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<div class="text-center d-md-none d-block">
    <hr>   
    <h2>Contact Us</h2>
    <div class="col">
        <a href="tel:000-000-0000" class="text-decoration-none text-dark">
            <i class="bi bi-telephone">&nbsp;(000)-000-0000</i>
        </a>
    </div>
    <div class="col">
        <a href="mailto:ScottsFurnitureBarn@gmail.com" class="text-decoration-none text-dark">
            <i class="bi bi-envelope-at">&nbsp;ScottsFurnitureBarn@gmail.com</i>
        </a>
    </div>
    <div class="col">
        <a href="contact.php" class="text-decoration-none text-dark">
            <i class="bi bi-pin-map">&nbsp;3489&nbsp;N&nbsp;Meridian&nbsp;Rd.&nbsp;Meridian&nbsp;ID&nbsp;83646</i>
        </a>
    </div>
    
</div>


<hr>

<div class="border border-black border-3 color-yellow mb-4 mx-4">
    <a href="about.php" class="text-decoration-none txt-brown" >
        <div class="container-fluid text-center">
            <h3>
            Click here to learn more about Scott's Funiture Barn
            </h3>
            <p class="d-md-block d-none">
            Over the past 5 years Scott's Furniture Barn has kept the ideal that one person's junk is another person's treasure. We believe that used furniture can still be great furniture, and should not be tossed in a landfill or on the side of the road when they become unwanted. That is where we come in...    
            </p>
        </div>
    </a>
</div>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
