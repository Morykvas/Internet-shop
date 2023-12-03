<?php
/**
 * сторінка на якій у нас виводять товари які вибрав користувач для покупки
 * в ньому він може редагувати кількість продукту і та оформлювати його вже для оплати на сторінці design-products-page.php
 */
session_start();
if (!isset($_SESSION)) {echo 'сесія непрацює';}
define('CSS_DIR', '../');
include_once '../connect.php';
include_once '../header.php';
?>
<section class="basket-page">
    <div class="container">
        <div class="wrapper-basket">
            <?php if($_SESSION['profile']) : ?>
                <h1>BASKET PAGE</h1>
                <a class="basket_link" href="all-products-page.php">повернутись</a>
                <a class="basket_link" href="design-products-page.php">оформлення замовлення</a>
                <?php 
                    $curentUserId = $_SESSION['profile']['user_id'];
                    $sql = "SELECT products.product_image, products.product_id, products.product_name, products.product_price, products.product_description, products.product_quontity, SUM(quota.product_quontity) AS total_quontity FROM products INNER JOIN quota ON products.product_id = quota.product_id WHERE quota.user_id = $curentUserId GROUP BY products.product_image,  products.product_id, products.product_id, products.product_name, products.product_price, products.product_description, products.product_quontity";
                    $result = mysqli_query($connect, $sql);
                ?>
                <div class="my_products">
                    <?php  while($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="products_card">
                            <div class="wrapp-image-card">
                                <img src="data:image/jpg;base64, <?php echo  base64_encode($row['product_image']);?>" />
                            </div>
                            <div class="wrapp-desc">
                                <div class="item-desc">
                                    <span class="tittle-products">Назва:</span><p><?= $row['product_name']; ?></p>
                                </div>
                                <div class="item-desc">
                                    <span class="tittle-products">Опис:</span><p><?= $row['product_description']; ?></p>
                                </div>
                                <div class="item-desc">
                                    <span class="tittle-products"> Загальна ціна:</span><p><?= $row['product_price'] *  $row['total_quontity'] ; ?></p><span class="tittle-products"> грн.</span>
                                </div>
                            </div>
                            <?php 
                                $product_id = $row['product_id'];
                                $product_quontity = $row['product_quontity'];
                            ?>
                            <div class="wrapp-delete-form">
                                <form class="form-order" action="../data_processor/buy-products.php" method="post">
                                    <?php  $quontityTotal = $row['total_quontity'];?>  
                                    <input class="select-order" type="number" name="buy_quontity" min="" max="" value="<?= $quontityTotal;?>">
                                    <input type="hidden" name="product_id" value="<?= $product_id;?>">
                                    <input type="hidden" name="user_id" value="<?= $curentUserId; ?>">
                                    <input class="order-button" type="submit" value="Оформити">
                                </form>
                                <form class="form-delete-product" action="../data_processor/delete-products.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $curentUserId; ?>">
                                    <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                                    <input type="hidden" name="product_quontity" value="<?= $product_quontity; ?>">                  
                                    <input class="delete-button" type="submit" value="">
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
mysqli_close($connect);
define('SCRIPT_DIR', '../js/');
include '../footer.php';
?>