<?php 
/**
 *  обробник в якому перевіряється значення по якому буде відбуватись сортування по признаках 
 * сесія зі значенням передається до сторінки категорії для сортування по вибраному признаку
 */
session_start();
if(!isset($_SESSION)) {'сесія не працює';}
include_once "../connect.php";

$sortBy = variableValidation($_POST['select_sort_by']);

switch ($sortBy) {
        case 'orderOne':
            $orderBy = 'product_price'; 
            break;
        case 'orderTwo':
            $orderBy = 'product_name';
            break;
        case 'orderTree':
            $orderBy = 'product_id'; 
            break;
        case 'orderFour':
            $orderBy = 'sales_count DESC'; 
            break;
        default:
            $orderBy = 'product_id'; 
}
$_SESSION['sort_by'] =  $orderBy;
header('Location: ../pages/products-categories-page.php');

  