<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/PartnerService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $partners = readPartner("Activ = 1");
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
            <h1>Partners</h1>
            <?php
                if(isset($_GET['errors'])) {
                    echo '<p class="error">';
                    echo $_GET['errors'];
                    echo '</p>';
                }
            ?>
            <a class="button add" href="./PostPartner.php">Add Partner</a>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>Partner Name</th>
                        <th>City</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($partners as $partner) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$partner["idPartener"].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$partner['Denumire'].'</td>';
                            echo '<td>'.$partner['Oras'].'</td>';
                            echo '<td>';
                            echo '<a class="button edit" href="./PostPartner.php?id='.$partner['idPartener'].'">Edit</a>';
                            echo '<a class="button delete" href="/Proiect/Controllers/Partner/Delete.php?id='.$partner['idPartener'].'">Delete</a>';
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