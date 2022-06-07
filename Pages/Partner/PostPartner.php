<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/PartnerService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    if(isset($_GET['id'])) {
        $partner = readPartner('idPartener = '.$_GET['id'])->fetch_assoc();
    }else{
        $partner["idPartener"] = "";
        $partner["Denumire"] = "";
        $partner["Oras"] = "";
        $partner["Strada"] = "";
        $partner["Numar"] = "";
        $partner["Bloc"] = "";
        $partner["Scara"] = "";
        $partner["Apartament"] = "";
        $partner["NrRegistrulComertului"] = "";
        $partner["CodFiscal"] = "";
        $partner["DenumireBanca"] = "";
        $partner["ContIban"] = "";
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
            <form action="/Proiect/Controllers/Partner/Update.php" method="POST">
                <div class="formWraper">
                <input type="hidden" name="id" value="<?php echo $partner['idPartener']; ?>">
                <div class="formGroup">
                    <label for="name">Partner Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $partner['Denumire']; ?>">
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
                    <input type="text" name="tradeNumber" id="tradeNumber" value="<?php echo $partner['NrRegistrulComertului']; ?>">
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
                    <input type="text" name="fiscalCode" id="fiscalCode" value="<?php echo $partner['CodFiscal']; ?>">
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
                    <input type="text" name="bankName" id="bankName" value="<?php echo $partner['DenumireBanca']; ?>">
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
                    <input type="text" name="ibanAccount" id="ibanAccount" value="<?php echo $partner['ContIban']; ?>">
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
                    <input type="text" name="city" id="city" value="<?php echo $partner['Oras']; ?>">
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
                    <input type="text" name="street" id="street" value="<?php echo $partner['Strada']; ?>">
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
                    <input type="text" name="number" id="number" value="<?php echo $partner['Numar']; ?>">
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
                    <input type="text" name="block" id="block" value="<?php echo $partner['Bloc']; ?>">
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
                    <input type="text" name="staircase" id="staircase" value="<?php echo $partner['Scara']; ?>">
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
                    <input type="text" name="apartment" id="apartment" value="<?php echo $partner['Apartament']; ?>">
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