<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/PartnerService.php";
    if(!(LoginDelegator::isAdmin())) {
        header('location: ../../404.php');
        exit();
    }
        $partner["Activ"] = 0;
        updatePartner($partner, "idPartener = '".$_GET['id']."'");

    header('location: /Proiect/Pages/Partner/Partners.php');
    exit();
?>