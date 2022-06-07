<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isAdmin())) {
        header('location: ../../404.php');
        exit();
    }
        $deposit["Activ"] = 0;
        updateDeposit($deposit, "idDepozit = '".$_GET['id']."'");

    header('location: /Proiect/Pages/Deposit/Deposits.php');
    exit();
?>