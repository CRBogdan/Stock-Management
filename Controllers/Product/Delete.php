<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    if(!(LoginDelegator::isAdmin())) {
        header('location: ../../404.php');
        exit();
    }
        $product["Activ"] = 0;
        updateProduct($product, "idProdus = '".$_GET['id']."'");

    header('location: /Proiect/Pages/Product/Products.php');
    exit();
?>