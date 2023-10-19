<?php 
# обробник форми де юзер вносить товар 
 session_start();  
 if(!isset($_SESSION)) { echo 'сесія непрацює';}
 include_once '../connect.php';

$prodName     = variableValidation($_POST['product_name']);
$prodPrice    = variableValidation($_POST['product_price']);
$prodDesc     = variableValidation($_POST['product_description']);
$prodQuan     = variableValidation($_POST['product_quontity']);
$user_id      = variableValidation($_POST['user_id']);
$is_order     = variableValidation($_POST['is_order']);
$imageProduct = variableValidation($_FILES['file']['tmp_name']);

try {
    if ($prodName && $prodPrice && $prodDesc && $prodQuan && $user_id && $is_order && $imageProduct) {
    
        $is_order_value = '';
        if($is_order == 'one') {
            $is_order_value = 0;
        } elseif($is_order == 'two') {
            $is_order_value = 1;
        }
        
        $imageContent = file_get_contents($imageProduct);
        $escapedImageContent = mysqli_real_escape_string($connect, $imageContent);
    
        $sql = "INSERT INTO products (product_name, product_price, product_description, product_quontity, user_id, is_order, product_image) VALUES ('$prodName', '$prodPrice', '$prodDesc', '$prodQuan', '$user_id', '$is_order_value', '$escapedImageContent')";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            validationMessage('Ви успішно завантажили продукт');
            header('Location: ../pages/set-products-page.php');
        } else {
            throw new Exception('помилка при виконанні запиту');
        }
        
    } else {
        invalidMessage('Bи заповнили не всі поля, для завантаження продукту заповніть всі параметри');
        header('Location: ../pages/set-products-page.php');
        throw new Exception('Форма не пройшла валідацію користувач не заповнив всі поля');
    }
} catch (Exception $e) {
    error_log("Файл: " . $e->getFile() . "  Рядок: " . $e->getLine() . "  Повідомлення: " . $e->getMessage() . PHP_EOL, 3, "../var/log/set-product.log");

}

mysqli_close($connect);