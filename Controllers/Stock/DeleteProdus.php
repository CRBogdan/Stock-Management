<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
require_once "$root/Services/login_delegator.php";
require_once "$root/Services/StockService.php";
if(!(LoginDelegator::isAdmin())) {
    header('location: ../../404.php');
    exit();
}

    deleteStock('idStoc = '.$_GET['id']);

header('location: /Proiect/Pages/Stock/Stocks.php?id=' . $_GET['idDepozit']);
exit();
?>