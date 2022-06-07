<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductTransactionService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    
    deleteProductTransaction('idProdus_Tranzactie = '.$_GET['idProd']);
    header("location: /Proiect/Pages/Transaction/PostTransactionProducts.php?id=".$_GET['idTran']);
    exit();
?>