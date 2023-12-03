<?php
    /**
     * сторінка категорії 
     * ту знаходться лиш ті продукти категорії якої ви обрали 
     * та стоїть фільрація за признаками для пошуку потрібного товару з категорії
     */
    session_start();
    if(!isset($_SESSION)) {'сесія не працює';}
    const CSS_DIR = '../';
    include_once '../header.php';
    include_once '../connect.php';
?>
<section class="all-products-page">
    <div class="container">
        <div class="wrapper-all-products">
            
            <div class="item-all-products">
                <a href="all-products-page.php">повернутись</a>
                <a href="basket-page.php">кошик</a>
            </div>
            <?php 
                $categoryId   =  $_SESSION['category_data']['category_id'];
                $categoryNmae =  $_SESSION['category_data']['category_name'];
                $sortBy = $_SESSION['sort_by'];
            
                $sql = "SELECT * FROM products WHERE is_order = 1 AND category_id = $categoryId ORDER BY $sortBy";
                $result = mysqli_query($connect, $sql);
            ?>
            <h1 class="all-prod-tittle"><?= $categoryNmae ?></h1>
            <div class="wrapper_content_products">
                <div class="sidebar_categories_select">
                    <form class="form-select_category" action="../data_processor/sort-by-products.php" method="post">
                        <label for="select_sort">Сортувати за </label>
                        <select class="select_sort" name="select_sort_by">
                        
                        <option value="orderOne">Ціна</option>
                        <option value="orderTwo">Назва товару</option>
                        <option value="orderTree">Позиція</option>
                        <option value="orderFour">По популярності</option>
                        </select>
                        <input type="submit" value="сортувати">
                    </form>
                </div>
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
   </div>
</section>
<?php
    mysqli_close($connect);
    include_once '../footer.php';
?>