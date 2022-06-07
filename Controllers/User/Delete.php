<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/UserService.php";
    if(!(LoginDelegator::isAdmin())) {
        header('location: ../../404.php');
        exit();
    }
    deleteUser("idUtilizator = '".$_GET['id']."'");

    header('location: /Proiect/Pages/User/Users.php');
        exit();
?>