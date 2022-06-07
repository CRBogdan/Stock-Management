<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    if(isset($_GET['id'])) {
        $deposit = readDeposit('idDepozit = '.$_GET['id'])->fetch_assoc();
    }else{
        $deposit["idDepozit"] = "";
        $deposit["Denumire"] = "";
        $deposit["Oras"] = "";
        $deposit["Strada"] = "";
        $deposit["Numar"] = "";
        $deposit["Bloc"] = "";
        $deposit["Scara"] = "";
        $deposit["Apartament"] = "";
        $deposit["NrRegistrulComertului"] = "";
        $deposit["CodFiscal"] = "";
        $deposit["DenumireBanca"] = "";
        $deposit["ContIban"] = "";
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
            <h1>Edit Deposit</h1>
            <form action="/Proiect/Controllers/Deposit/Update.php" method="POST">
                <div class="formWraper">
                <input type="hidden" name="id" value="<?php echo $deposit['idDepozit']; ?>">
                <div class="formGroup">
                    <label for="name">Deposit Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $deposit['Denumire']; ?>">
                    <?php
                        if(isset($errors['Denumire'])) {
                            foreach($errors['Denumire'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="tradeNumber">Trade Register Number</label>
                    <input type="text" name="tradeNumber" id="tradeNumber" value="<?php echo $deposit['NrRegistrulComertului']; ?>">
                    <?php
                        if(isset($errors['NrRegistrulComertului'])) {
                            foreach($errors['NrRegistrulComertului'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="fiscalCode">Fiscal Code</label>
                    <input type="text" name="fiscalCode" id="fiscalCode" value="<?php echo $deposit['CodFiscal']; ?>">
                    <?php
                        if(isset($errors['CodFiscal'])) {
                            foreach($errors['CodFiscal'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="bankName">Bank Name</label>
                    <input type="text" name="bankName" id="bankName" value="<?php echo $deposit['DenumireBanca']; ?>">
                    <?php
                        if(isset($errors['DenumireBanca'])) {
                            foreach($errors['DenumireBanca'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="ibanAccount">IBAN account</label>
                    <input type="text" name="ibanAccount" id="ibanAccount" value="<?php echo $deposit['ContIban']; ?>">
                    <?php
                        if(isset($errors['ContIban'])) {
                            foreach($errors['ContIban'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="<?php echo $deposit['Oras']; ?>">
                    <?php
                        if(isset($errors['Oras'])) {
                            foreach($errors['Oras'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="street">Street</label>
                    <input type="text" name="street" id="street" value="<?php echo $deposit['Strada']; ?>">
                    <?php
                        if(isset($errors['Strada'])) {
                            foreach($errors['Strada'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="number">Number</label>
                    <input type="text" name="number" id="number" value="<?php echo $deposit['Numar']; ?>">
                    <?php
                        if(isset($errors['Numar'])) {
                            foreach($errors['Numar'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="block">Block</label>
                    <input type="text" name="block" id="block" value="<?php echo $deposit['Bloc']; ?>">
                    <?php
                        if(isset($errors['Bloc'])) {
                            foreach($errors['Bloc'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="staircase">Staircase</label>
                    <input type="text" name="staircase" id="staircase" value="<?php echo $deposit['Scara']; ?>">
                    <?php
                        if(isset($errors['Scara'])) {
                            foreach($errors['Scara'] as $error) {
                                echo '<p class="error">'.$error.'</p>';
                            }
                        }
                    ?>
                </div>
                <div class="formGroup">
                    <label for="apartment">Apartment</label>
                    <input type="text" name="apartment" id="apartment" value="<?php echo $deposit['Apartament']; ?>">
                    <?php
                        if(isset($errors['Apartament'])) {
                            foreach($errors['Apartament'] as $error) {
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