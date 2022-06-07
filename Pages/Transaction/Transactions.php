<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/TransactionService.php";
    require_once "$root/Services/PartnerService.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isLoggedIn())) {
        header("location: $root/404.php");
        exit();
    }
    if(LoginDelegator::isAdmin()) {
        $transactions = readTransaction();
    }
    else{
        $transactions = readTransaction("idDepozit = " . LoginDelegator::getIdDepozit());
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
    <link rel="stylesheet" href="/Proiect/Style/Table.css">
</head>

<body>
    <?php include "$root/Header.php"; ?>

    <main class="table">
        <div class="container">
            <h1>Transactions</h1>
            <?php
                if(isset($_GET['errors'])) {
                    echo '<p class="error">';
                    echo $_GET['errors'];
                    echo '</p>';
                }
                if(LoginDelegator::isAdmin())
                echo '<a class="button add" href="./PostTransaction.php">Add Transaction</a>';
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>Transaction Type</th>
                        <th>Deposit</th>
                        <th>Partner</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($transactions as $transaction) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$transaction["idTranzactie"].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$transaction['tipTranzactie'].'</td>';
                            $deposit = readDeposit('idDepozit ='.$transaction['idDepozit'])->fetch_assoc();
                            echo '<td>'.$deposit['Denumire'].'</td>';
                            $partner = readPartner('idPartener ='.$transaction['idPartener'])->fetch_assoc();
                            echo '<td>'.$partner['Denumire'].'</td>';
                            echo '<td>';
                            echo '<a class="button add" target="black" href="/Proiect/Pages/Invoice/Invoice.php?id='.$transaction['idTranzactie'].'">View Invoice</a>';
                            if(LoginDelegator::isAdmin())
                            {
                            echo '<a class="button edit" href="./PostTransaction.php?id='.$transaction['idTranzactie'].'">Edit</a>';
                            echo '<a class="button delete" href="/Proiect/Controllers/Transaction/Delete.php?id='.$transaction['idTranzactie'].'">Delete</a>';
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