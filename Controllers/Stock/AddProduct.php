<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
require_once "$root/Services/login_delegator.php";
require_once "$root/Services/StockService.php";
if(!(LoginDelegator::isAdmin())) {
    header('location: ../../404.php');
    exit();
}

    if($_POST["product"] != '-1') {
        $stock["idProdus"] = $_POST['product'];
        $stock["idDepozit"] = $_POST['id'];
        $stock["Cantitate"] = 0;

        createStock($stock);
    }


header('location: /Proiect/Pages/Stock/Stocks.php?id=' . $_POST['id']);
exit();
?>