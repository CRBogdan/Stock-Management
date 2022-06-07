<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/TransactionService.php";
    require_once "$root/Services/DepositService.php";
    require_once "$root/Services/PartnerService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    if(isset($_GET['id'])) {
        $transaction = readTransaction('idTranzactie = '.$_GET['id'])->fetch_assoc();
    }else{
        $transaction['idTranzactie'] = '';
        $transaction['idDepozit']='';
        $transaction['idPartener']='';
        $transaction['tipTranzactie']='';
    }
    $deposits = readDeposit();
        $partners = readPartner();
        $transactionType = [
            'sell' => 'Sell',
            'buy' => 'Buy'
        ];
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
            <h1>Edit Transaction</h1>
            <form action="/Proiect/Controllers/Transaction/AddTransaction.php" method="POST">
                <div class="formWraper">
                    <input type="hidden" name="id" value="<?php echo $transaction['idTranzactie']; ?>">
                    <div class="formGroup">
                        <label for="idDepozit">Deposit</label>
                        <select name="idDepozit" id="idDepozit">
                            <?php
                                if($transaction['idDepozit'] == "") {
                                    echo '<option value="-1" selected>Select a deposit</option>';
                                }
                            ?>

                            <?php
                            foreach($deposits as $deposit) {
                                    if($transaction['idDepozit'] == $deposit['idDepozit']) {
                                        echo '<option value="'.$deposit['idDepozit'].'" selected>'.$deposit['Denumire'].'</option>';
                                    }else{
                                        echo '<option value="'.$deposit['idDepozit'].'">'.$deposit['Denumire'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <?php if(isset($errors['idDepozit'])) {
                                foreach($errors['idDepozit'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>

                    <div class="formGroup">
                        <label for="idPartener">Partner</label>
                        <select name="idPartener" id="idPartener">
                            <?php
                                if($transaction['idPartener'] == "") {
                                    echo '<option value="-1" selected>Select a partner</option>';
                                }
                            ?>

                            <?php
                            foreach($partners as $partner) {
                                    if($transaction['idPartener'] == $partner['idPartener']) {
                                        echo '<option value="'.$partner['idPartener'].'" selected>'.$partner['Denumire'].'</option>';
                                    }else{
                                        echo '<option value="'.$partner['idPartener'].'">'.$partner['Denumire'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <?php if(isset($errors['idPartener'])) {
                                foreach($errors['idPartener'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>

                    <div class="formGroup">
                        <label for="transactionType">Partner</label>
                        <select name="transactionType" id="transactionType">
                            <?php
                                if($transaction['tipTranzactie'] == "") {
                                    echo '<option value="-1" selected>Select a transaction type</option>';
                                }
                            ?>

                            <?php
                            foreach($transactionType as $transactionKey => $transactionValue) {
                                    if($transactionValue == $partner['tipTranzactie']) {
                                        echo '<option value="'.$transactionValue.'" selected>'.$transactionValue.'</option>';
                                    }else{
                                        echo '<option value="'.$transactionValue.'">'.$transactionValue.'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <?php if(isset($errors['transactionType'])) {
                                foreach($errors['transactionType'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                </div>


                    <div class="submitWraper">
                        <button class="button submit">Next</button>
                    </div>
            </form>
        </div>
    </main>
</body>

</html>