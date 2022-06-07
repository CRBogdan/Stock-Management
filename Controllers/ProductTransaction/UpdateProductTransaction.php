<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    require_once "$root/Services/ProductTransactionService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $data['idProdus'] = $_POST['idProdus'];
    $data['Cantitate'] = $_POST['cantitate'];

    updateProductTransaction($data, 'idProdus_Tranzactie = '.$_POST['idProd']);

    header("location: /Proiect/Pages/Transaction/PostTransactionProducts.php?id=".$_POST['idTran'] );
    exit();
?>