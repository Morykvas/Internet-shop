<?php 
    session_start();  
    if(!isset($_SESSION)) { echo 'сесія непрацює';}
    include_once "../connect.php";
    define('CSS_DIR', '../');
    include_once '../header.php';
   
 ?>
<section class="products-page">
    <div class="container">
        <div class="wrapper-product-content">
            <?php if(isset($_SESSION['profile'])) : ?>
                <div class="wrapp-tytle-link">
                    <a href="../customer/index.php">повернуись</a>
                    <h1 class="title-product">Set Products</h1>
                </div>
                <form class="form_product" action="../data_processor/set-process_product.php"  method="post"  enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['profile']['user_id']; ?>">
                        <label for="product_name">Назва продукту</label>
                        <input type="text" name="product_name">

                        <label for="product_price">Ціна продукту</label>
                        <input type="text" name="product_price">

                        <label for="product_description">Опис продукту</label>
                        <textarea class="product_area" name="product_description"></textarea>
 
                        <label for="product_quantity">Наявна кількість</label>
                        <input type="text" name="product_quontity">

                        <label for="file">Оберіть фото:</label>
                        <input type="file" name="file" accept="image/*">

                        <div class="item-radio">

                            <input type="radio" name="is_order" value="one">
                            <span class="switch-span" >приватний</span> 
                        </div>

                        <div class="item-radio">
                            <input type="radio" name="is_order" value="two"> 
                            <span class="switch-span" >публічний</span>  
                        </div>

                        <input type="submit" value="Викласти">
            <?php endif; ?>
                <?php
                    echo sessionMessageInvalid('invalidMessage');
                    echo sessionMessageValid('validationMessage');
                ?>
                </form>
            <?php mysqli_close($connect); ?>
        </div>
    </div>
</section>  
<?php include_once '../footer.php'; ?>