<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/TransactionService.php";
    require_once "$root/Services/ProductTransactionService.php";
    if(!(LoginDelegator::isAdmin())) {
        header('location: ../../404.php');
        exit();
    }
    $transaction = readTransaction('idTranzactie ='.$_GET['id'])->fetch_assoc();

    deleteProductTransaction('idTranzactie ='.$transaction['idTranzactie']);
    deleteTransaction("idTranzactie = '".$_GET['id']."'");

    header('location: /Proiect/Pages/Transaction/Transactions.php');
        exit();
?>