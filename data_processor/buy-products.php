<?php 
session_start();
if(!isset($_SESSION)) { echo 'сесія непрацює';}
include_once '../connect.php';

$buyQuontity =  variableValidation($_POST['buy_quontity']);
$productId = variableValidation($_POST['product_id']);
$userId = variableValidation($_POST['user_id']);

try {
   
    if($buyQuontity && $productId && $userId) {
        header('Location: ../pages/basket-page.php');
        $sqlSelectProduct = "SELECT product_quontity FROM products WHERE product_id = $productId";
        $sqlResultProducts = mysqli_query($connect, $sqlSelectProduct);
        
        if( $row = mysqli_fetch_assoc($sqlResultProducts) ) {
        
            $sqlSelectQuota = "SELECT * FROM quota WHERE user_id =$userId AND product_id=$productId";
            $resultSelectQuota = mysqli_query($connect, $sqlSelectQuota);
            
            if( $row = mysqli_fetch_assoc($resultSelectQuota) ) {
                $currentQuontity = $row['product_quontity'];
            } else {
                throw new Exception('Отрити дані кількості пролукту з таблиці quota не вдалось');
            }

            $excess = $buyQuontity - $currentQuontity;
            $positiveExcess = abs($excess);
            
            $setQuontity = 0;
            if($buyQuontity > $currentQuontity  ) {
                # Замовлення більше ніж поточне число
                $setQuontity = $positiveExcess;
                $setSumQuontity =  $currentQuontity  -  $setQuontity;

            }elseif ($buyQuontity < $currentQuontity) {
                # Замовлення менше ніж число 
                $setQuontity = $positiveExcess;
                $setSumQuontity =  $currentQuontity  + $setQuontity;
            }

            $sqlUpdateProducts = "UPDATE products SET product_quontity=$setSumQuontity WHERE product_id=$productId";
            $resultUpdateProducts = mysqli_query($connect, $sqlUpdateProducts);
            if($resultUpdateProducts) {

                $sqlUpdateQuota = "UPDATE quota SET product_quontity=0 WHERE product_id=$productId";
                $resultUpdateQuota = mysqli_query($connect, $sqlUpdateQuota);

                if(!$resultUpdateQuota) {
                    throw new Exception('не вдалось оновити табилцю quota');
                }
                
            } else {
                throw new Exception('кількість товару не не повернулось в products');
            }
        } 
    }
 
} catch (Exception $e) {
    error_log("Файл: " . $e->getFile() . "  Рядок: " . $e->getLine() . "  Повідомлення: " . $e->getMessage() . PHP_EOL, 3, "../var/log/buy-products.log");
}

mysqli_close($connect);