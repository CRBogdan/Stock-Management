<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/validator.php";
    require_once "$root/Services/TransactionService.php";

    $transaction['idTranzactie'] = $_POST['id'];
    $transaction['idDepozit'] = $_POST['idDepozit'];
    $transaction['idPartener '] = $_POST['idPartener'];
    $transaction['tipTranzactie'] = $_POST['transactionType'];

    foreach($_POST as $key => $value) {
        if($value == '-1') {
            $errors[$key][] = 'Must select a value';
        }
    }

    if(isset($errors)){
        header("location: /Proiect/Pages/Transaction/PostTransaction.php?".http_build_query(['errors' => $errors]));
        exit();
    }
    else{
        if($transaction['idTranzactie']!=''){
            updateTransaction($transaction, 'idTranzactie='.$transaction['idTranzactie']);
        }
        else{
            createTransaction($transaction);
            $transaction = readTransaction();
            foreach($transaction as $tr){
                $tran = $tr;
            }
            $transaction = $tran;
        }
        header("location: /Proiect/Pages/Transaction/PostTransactionProducts.php?id=".$transaction['idTranzactie']);
    }
?>