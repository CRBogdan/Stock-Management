<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/ProductService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    if(isset($_GET['id'])) {
        $product = readProduct('idProdus = '.$_GET['id'])->fetch_assoc();
    }else{
        $product["idProdus"] = "";
        $product["Serial"]= "";
        $product["Brand"] = "";
        $product["Model"] = "";
        $product["Pret"] = "";
        $product["Descriere"] = "";
    }
    if(isset($_GET['errors'])) {
        $errors = $_GET['errors'];
    }
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
</head>

<body>
    <?php include "$root/Header.php"; ?>

    <main class="edit">
        <div class="container">
            <h1>Edit Partner</h1>
            <form action="/Proiect/Controllers/Product/Update.php" method="POST">
            <div class="formWraper">
                <input type="hidden" name="id" value="<?php echo $product['idProdus']; ?>">
                <div class="formGroup">
                    <label for="serial">Serial No.</label>
                    <input type="text" name="serial" id="serial" value="<?php echo $product['Serial']; ?>">
                    <?php
                        if(isset($errors) && $errors['serial']) {
                            echo '<p class="error">';
                            echo $errors['serial'];
                            echo '</p>';
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" value="<?php echo $product['Brand']; ?>">
                    <?php
                        if(isset($errors['Brand'])) {
                            foreach($errors['Brand'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="model">Model</label>
                    <input type="text" name="model" id="model" value="<?php echo $product['Model']; ?>">
                    <?php
                        if(isset($errors['Model'])) {
                            foreach($errors['Model'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" value="<?php echo $product['Pret']; ?>">
                    <?php
                        if(isset($errors['Price'])) {
                            foreach($errors['Price'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"><?php echo $product['Descriere']; ?></textarea>
                    <?php
                        if(isset($errors['Description'])) {
                            foreach($errors['Description'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                </div>
                <div class="submitWraper">
                    <button class="button submit">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>