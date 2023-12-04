<?php
    session_start();
    const CSS_DIR = '../';
    include_once '../header.php';
    include_once '../connect.php';
?>
<section class="all-products-page">
    <div class="container">
        <div class="wrapper-all-products">
            <div class="item-all-products">
                <a href="../customer/index.php">повернутись</a>
                <a href="basket-page.php">кошик</a>
            </div>
            <h1 class="all-prod-tittle">ALL PRODUCTS</h1>
            <?php 
                $sql = "SELECT * FROM products WHERE is_order = 1";
                $result = mysqli_query($connect, $sql);
            ?>
            <div class="my_products">
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="products_card">
                        <div class="wrapp-image-card">
                            <img src="data:image/jpg;base64, <?= base64_encode($row['product_image']);?>" />
                        </div>
                        <div class="wrapp-desc">
                            <div class="item-desc">
                                <span class="tittle-products">Назва:</span><p><?= $row['product_name']; ?></p>
                            </div>
                            <div class="item-desc">
                                <span class="tittle-products">Опис:</span><p><?= $row['product_description']; ?></p>
                            </div>
                            <div class="item-desc">
                                <span class="tittle-products">Ціна:</span><p><?= $row['product_price']; ?></p>
                            </div>
                            <div class="item-desc">
                                <span class="tittle-products">Кількість:</span><p><?= $row['product_quontity']; ?></p>
                            </div>
                        </div>
                        <div class="wrapper-form-cards">
                            <form class="form-add-products" action="../data_processor/set_basket.php" method="post">
                                <input type="hidden"  name="user_id" value="<?= $_SESSION['profile']['user_id'];?>">  
                                <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                                <select name="product_quontity"> 
                                    <?php 
                                    $productQuantity = $row['product_quontity'];
                                    for ($i = 1; $i <= $productQuantity; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="додати">
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
   </div>
</section>
<?php
    mysqli_close($connect);
    include_once '../footer.php';
?>