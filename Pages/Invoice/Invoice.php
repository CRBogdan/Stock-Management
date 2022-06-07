<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/TransactionService.php";
    require_once "$root/Services/ProductTransactionService.php";
    require_once "$root/Services/PartnerService.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isLoggedIn())) {
        header("location: $root/404.php");
        exit();
    }
    $id = $_GET['id'];
    $transaction = readTransaction('idTranzactie = ' . $id)->fetch_assoc();
    $transactionProd = readProductsFromTransaction('idTranzactie = '.$id);
    $partner = readPartner('idPartener='.$transaction['idPartener'])->fetch_assoc();
    $deposit = readDeposit('idDepozit='.$transaction['idDepozit'])->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proiect/Style/Invoice.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <table class="head">
            <thead>
                <tr>
                    <th colspan="2">
                        From:
                    </th>
                    <th colspan="2">
                        To:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Denumire:
                    </td>
                    <td>
                        <?php echo $partner['Denumire'] ?>
                    </td>
                    <td>
                        Denumire:
                    </td>
                    <td>
                        <?php echo $deposit['Denumire'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nr. Registrul Comertului:
                    </td>
                    <td>
                        <?php echo $partner['NrRegistrulComertului'] ?>
                    </td>
                    <td>
                        Nr. Registrul Comertului:
                    </td>
                    <td>
                        <?php echo $deposit['NrRegistrulComertului'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Cod Fiscal:
                    </td>
                    <td>
                        <?php echo $partner['CodFiscal'] ?>
                    </td>
                    <td>
                    Cod Fiscal:
                    </td>
                    <td>
                        <?php echo $deposit['CodFiscal'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Cont IBAN:
                    </td>
                    <td>
                        <?php echo $partner['ContIban'] ?>
                    </td>
                    <td>
                    Cont IBAN:
                    </td>
                    <td>
                        <?php echo $deposit['ContIban'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Adresa:
                    </td>
                    <td>
                        <?php echo $partner['Oras']." ".$partner["Strada"]." ".$partner["Numar"]." ".$partner["Bloc"]." ".$partner["Scara"]." ".$partner["Apartament"] ?>
                    </td>
                    <td>
                    Adresa:
                    </td>
                    <td>
                    <?php echo $deposit['Oras']." ".$deposit["Strada"]." ".$deposit["Numar"]." ".$deposit["Bloc"]." ".$deposit["Scara"]." ".$deposit["Apartament"] ?>
                    </td>
                </tr>
        </table>
    </div>
</body>
</html>