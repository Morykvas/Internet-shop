<?php 
    session_start();  
    if(!isset($_SESSION)) { echo 'сесія непрацює';}
    define('CSS_DIR', '../');
    include_once "../connect.php";
    include_once '../header.php';
?>
<section class="private-products-page">
    <div class="wrapper-title-edit">
        <a href="private-products-page.php">повернуись</a>
        <h1>Редагування продуктів</h1>
    </div>
    <div class="update-products"> 
        <?php 
           echo $product_id = $_GET['product_id'];  
        ?>
        <form class="form_product" action="../data_processor/edit-products.php"  method="post"  enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $product_id; ?>">

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

                <input type="submit" value="Редагувати">
                
                <?php 
                   echo sessionMessageInvalid('invalidMessage');
                   echo sessionMessageValid('validationMessage');
                ?>
        </form>
   </div> 
</section>

<?php 
include_once '../footer.php'; 
mysqli_close($connect);
?>