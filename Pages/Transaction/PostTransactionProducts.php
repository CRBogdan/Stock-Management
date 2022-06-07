<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    require_once "$root/Services/ProductTransactionService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $id = $_GET['id'];
    $transactions = readProductsFromTransaction('idTranzactie = '.$id);
    $products = readProduct();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>Document</title>
    <link rel="stylesheet" href="/Proiect/Style/Edit.css">
    <link rel="stylesheet" href="/Proiect/Style/Table.css">
</head>

<body>
    <?php include "$root/Header.php"; ?>

    <main class="edit">
        <div class="container">
            <h1>Edit Transaction</h1>
            <div class="block">
            <a class="button edit" href=<?php echo "/Proiect/Controllers/ProductTransaction/AddProductTransaction.php?id=".$id ?>>Add Product</a>
            </div>
            <?php
            foreach($transactions as $transaction)
            {
            echo '
            <form action="/Proiect/Controllers/ProductTransaction/UpdateProductTransaction.php" method="POST" class="heightAuto">
                <div class="formWraper">
                    <input type="hidden" name="idProd" value="'.$transaction['idProdus_Tranzactie'].'">
                    <input type="hidden" name="idTran" value="'.$transaction['idTranzactie'].'">
                    <div class="formGroup">
                        <label for="idProdus">Product</label>
                        <select name="idProdus" id="idProdus">
                            <option value="">Select a product</option>';
                            foreach($products as $product) {
                                if($product['idProdus'] == $transaction['idProdus']) {
                                    echo '<option value="'.$product['idProdus'].'" selected>'.$product['Brand']." ".$product['Model'].'</option>';
                                } else {
                                    echo '<option value="'.$product['idProdus'].'">'.$product['Brand']." ".$product['Model'].'</option>';
                                }
                            }
            echo '
                        </select>
                    </div>

                    <div class="formGroup">
                        <label for="cantitate">Quantity</label>';
                        if(isset($transaction['Cantitate'])) {
                            echo '<input type="number" name="cantitate" id="cantitate" value="'.$transaction['Cantitate'].'">';
                        } else {
                            echo '<input type="number" name="cantitate" id="cantitate">';
                        }
            echo '
                    </div>

                    <div class="formGroup">
                        <button class="button submit">Save</button>
                        <a class="button edit" href="/Proiect/Controllers/ProductTransaction/DeleteProductTransaction.php?idTran='.$transaction['idTranzactie'].'&idProd='.$transaction['idProdus_Tranzactie'].'">Delete</a>
                    </div>
                </div>
            </form>';
            }
            ?>
        </div>
    </main>
</body>

</html>