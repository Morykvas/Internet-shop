<?php 
/**
 * сторінка продуктів юзера 
 * на цю сторінку може потрапити тільки авторизований користувач і там тільки продукти які він додав для себе 
 */
    session_start();  
    if(!isset($_SESSION)) { echo 'сесія непрацює';}
    define('CSS_DIR', '../');
    include_once "../connect.php";
    include_once '../header.php';
   
 ?>
<section class="private-products-page">
    <?php 
        $user_id = $_SESSION['profile']['user_id'];
        $sql = "SELECT * FROM products WHERE user_id=$user_id AND is_order=0";
        $result = mysqli_query($connect, $sql);
    ?>
    <div class="container">
        <div class="wrapper-products">
            <div class="wrapper-title">
                <a href="../customer/index.php">повернутись</a>
                <h1>Мої продукти</h1>
            </div>
            <div class="my_products">
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="products_card">
                        <div class="wrapp-image-card">
                            <img src="data:image/jpeg;base64, <?= base64_encode($row['product_image']);?>" />
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
                        <?php
                            $_SESSION['edit-product_id'] = $row['product_id'];
                            $product_id =  $_SESSION['edit-product_id'];
                        ?>
                        <a class="edit_link" href="edit-product-page.php?product_id=<?= $product_id; ?>">редагувати</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php 
include_once '../footer.php'; 
mysqli_close($connect);
?>