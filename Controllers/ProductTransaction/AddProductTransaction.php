<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    require_once "$root/Services/ProductTransactionService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $data['idTranzactie'] = $_GET['id'];

    createProductTransaction($data);

    header("location: /Proiect/Pages/Transaction/PostTransactionProducts.php?id=".$data['idTranzactie'] );
    exit();
?>