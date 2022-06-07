<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $deposits = readDeposit("Activ = 1");
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
            <a class="button add" href="./PostDeposit.php">Add Deposit</a>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>Deposit Name</th>
                        <th>City</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($deposits as $deposit) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$deposit["idDepozit"].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$deposit['Denumire'].'</td>';
                            echo '<td>'.$deposit['Oras'].'</td>';
                            echo '<td>';
                            echo '<a class="button edit" href="./PostDeposit.php?id='.$deposit['idDepozit'].'">Edit</a>';
                            echo '<a class="button delete" href="/Proiect/Controllers/Deposit/Delete.php?id='.$deposit['idDepozit'].'">Delete</a>';
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