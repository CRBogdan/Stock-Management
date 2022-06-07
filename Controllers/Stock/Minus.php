<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
require_once "$root/Services/login_delegator.php";
require_once "$root/Services/StockService.php";
if(!(LoginDelegator::isLoggedIn())) {
    header("location: $root/404.php");
    exit();
}
    $stock = readStock("idStoc = $_GET[id]");
    $stock = $stock->fetch_assoc();
    if($stock["Cantitate"]>0){
        $stock["Cantitate"]--;
    }
    updateStock($stock, "idStoc = $_GET[id]");

header('location: /Proiect/Pages/Stock/Stocks.php?id=' . $stock["idDepozit"]);
exit();
?>