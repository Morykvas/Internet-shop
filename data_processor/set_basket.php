<?php 
include '../connect.php';

$user_id          =  variableValidation($_POST['user_id']);
$product_id       =  variableValidation($_POST['product_id']);
$product_quontity = variableValidation($_POST['product_quontity']);

try {
    
    if(!empty($user_id) && !empty($product_id) && !empty($product_quontity)) {

        $sqlSelectProducts = "SELECT product_quontity FROM products WHERE product_id = $product_id";
        $resultSelectProducts = mysqli_query($connect, $sqlSelectProducts);
        
        if(mysqli_num_rows($resultSelectProducts) > 0 ) {
            $row = mysqli_fetch_assoc($resultSelectProducts);
            $currentProductQuantity = $row['product_quontity'];
            $totalQuontity = $currentProductQuantity - $product_quontity; 

           
            $sqlUpdate = "UPDATE products SET product_quontity= $totalQuontity WHERE product_id = $product_id";
            $resultUpdate = mysqli_query($connect, $sqlUpdate );
            if(!$resultUpdate) {
                throw new Exception('Товар не оновив кількість після завантаження в кошик');
            }
        }
        $sql = "INSERT INTO quota (user_id, product_id, product_quontity) VALUES ('$user_id', '$product_id', '$product_quontity')";    
        $result = mysqli_query($connect, $sql);
       
        if($result) {
            
            header('Location: ../pages/all-products-page.php');
        } else {
           throw new Exception('користувач не зміг додати продук в кошик');
        }

    }

} catch (Exception $e) {
    error_log("Файл: " . $e->getFile() . "  Рядок: " . $e->getLine() . "  Повідомлення: " . $e->getMessage() . PHP_EOL, 3, "../var/log/set-basket.log");
}
mysqli_close($connect); 