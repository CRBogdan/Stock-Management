<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $products = readProduct("Activ = 1");
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
            <h1>Products</h1>
            <?php
                if(isset($_GET['errors'])) {
                    echo '<p class="error">';
                    echo $_GET['errors'];
                    echo '</p>';
                }
            ?>
            <a class="button add" href="./PostProduct.php">Add Product</a>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>Serial No.</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($products as $product) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$product["idProdus"].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$product['Serial'].'</td>';
                            echo '<td>'.$product['Brand'].'</td>';
                            echo '<td>'.$product['Model'].'</td>';
                            echo '<td>'.$product['Pret'].'</td>';
                            echo '<td>';
                            echo '<a class="button edit" href="./PostProduct.php?id='.$product['idProdus'].'">Edit</a>';
                            echo '<a class="button delete" href="/Proiect/Controllers/Product/Delete.php?id='.$product['idProdus'].'">Delete</a>';
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