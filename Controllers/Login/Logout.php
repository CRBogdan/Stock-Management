<?php

if(isset($_POST['submit'])){
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    $loginDelegator = new LoginDelegator(new Validator);
    $loginDelegator->logout();
    header("location: ../../index.php");
    exit();
}

?>