<?php
include "reserve/models/reserveCart.php";
$_SESSION['totalPrice'] = 0;
?>

<div class="container pb-3">

    <h2 class="py-2 text-center">Reserved Items</h2>

    <?php if (empty($reservedRows)) { ?>
        <div class="text-center">
            <h3>Cart is empty</h3>
            <a class="btn btn-dark" href="./gallery.php">Click here to view our Gallery</a>
        </div>
    <?php } else { ?>

        <table class="table table-sm table-bordered align-middle table-hover table-light">
            <thead>
                <tr class="text-center">
                    <th>Item</th>
                    <th>Item Condition</th>
                    <th>Item Price</th>
                    <th>Remove Items</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($reservedRows as $row) { ?>

                    <?php
                    $imgData = base64_encode($row['Img']);
                    $imgSrc = "data:image/jpeg;base64,{$imgData}";
                    ?>

                    <tr>
                        <td class="col-12 col-sm-4 col-md-4 col-lg-2 text-center">
                            <img src="<?= $imgSrc ?>" alt="Product Image" class="img-fluid mx-auto mx-lg-0 h-100 col-8 col-sm-6 col-md-4 col-lg-2 rounded">
                            <br><?php echo htmlspecialchars($row['Name']); ?>
                        </td>
                        <td class="col-sm-4 col-md-4 col-lg-2 text-center"><?php echo htmlspecialchars($row['condition']); ?></td>
                        <td class="col-sm-4 col-md-4 col-lg-2 text-center">$<?php echo htmlspecialchars($row['Price']); ?></td>
                        <td class="col-sm-4 col-md-4 col-lg-2 text-center">
                            <a class="btn btn-danger" href="./reserve/models/reserveDelete.php?CartId=<?php echo $row["CartId"]; ?>" type="button">Remove</a>
                        </td>
                    </tr>

                    <?php
                    $_SESSION['totalPrice'] += $row['Price'];
                    ?>
                <?php } ?>
            </tbody>
        </table>

    <?php
        echo "<h5>Subtotal: $";
        echo $_SESSION['totalPrice'];
        echo "</h5>";

        $total = ($_SESSION['totalPrice'] * 0.06) + number_format((float)$_SESSION['totalPrice'], 2, '.', '');
        echo "<h5>Tax: 6%</h5>";
        echo "<h5>Total: $";
        echo number_format((float)$total, 2, '.', '');
        echo "</h5>";
    }
    ?>
    <div class="text-center">
        <?php if ($_SESSION['LoggedIn'] == true) {
            if (!empty($reservedRows)) {
        ?>
                <a class="btn btn-dark" href="reserve/models/reserveItems.php?CartId=<?php echo $row["CartId"]; ?>">Reserve Items</a>
            <?php }
        } else { ?>
            <a class="btn btn-dark" href="signup.php">Sign up for an account to reserve items</a>
        <?php } ?>


        <?php if (!empty($reservedRows)) { ?>
            <a class="btn btn-danger" href="./reserve/models/reserveDeleteAll.php">Remove All Items</a>
        <?php } ?>
    </div>
</div>
<style>

    </style>