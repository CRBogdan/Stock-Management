<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/UserService.php";
    require_once "$root/Services/StockService.php";
    require_once "$root/Services/ProductService.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isLoggedIn())) {
        header("location: $root/404.php");
        exit();
    }
    else{
        if(LoginDelegator::isUser()&&LoginDelegator::getIdDepozit()!=$_GET['id']){
            header("location: $root/404.php");
            exit();
        }
    }
    $stocks = readDeposit_Stock_Product("depozit.idDepozit = $_GET[id] And produs.Activ = 1");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>Document</title>
    <link rel="stylesheet" href="/Proiect/Style/Table.css">
</head>

<body>
    <?php include "$root/Header.php"; ?>

    <main class="table">
        <div class="container">
            <h1>Deposits</h1>
            <?php
                if(isset($_GET['errors'])) {
                    echo '<p class="error">';
                    echo $_GET['errors'];
                    echo '</p>';
                }
            ?>
            <?php
            if(LoginDelegator::isAdmin()){
            echo '
            <form method="Post" action="/Proiect/Controllers/Stock/AddProduct.php">';
                    $products = readProduct("Activ = 1");
            echo '
                <input type="hidden" name="id" value="'.$_GET['id'].'">
                <div>
                    <label for="product">Add product</label>
                    <select type="product" name="product" id="product">
                        <option value="-1">Select Product</option>';
                            foreach($products as $product) {
                                echo '<option value="' . $product['idProdus'] . '">' . $product['Brand']. ' '. $product['Model'] . '</option>';
                            }
            echo '
                    </select>
                </div>
                <div>
                    <button type="submit" name="add" class="button add">Add Deposit</button>
                </div>
            </form>';
                        }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>Deposit Name</th>
                        <th>Product</th>
                        <th>Cantitate</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($stocks as $stock) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$stock["idDepozit"].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$stock['Denumire'].'</td>';
                            echo '<td>'.$stock['Brand'].' '.$stock['Model'].'</td>';
                            echo '<td>'.$stock['Cantitate'].'</td>';
                            echo '<td>';
                            echo '<a class="button edit" href="/Proiect/Controllers/Stock/Minus.php?id='.$stock['idStoc'].'">-</a>';
                            echo '<a class="button add" href="/Proiect/Controllers/Stock/Plus.php?id='.$stock['idStoc'].'">+</a>';
                            if(LoginDelegator::isAdmin()){
                                echo '<a class="button delete" href="/Proiect/Controllers/Stock/DeleteProdus.php?id='.$stock['idStoc'].'&idDepozit='. $stock['idDepozit'] .'">Delete</a>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>