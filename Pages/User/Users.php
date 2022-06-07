<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/UserService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    $users = readUser();
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
            <h1>Users</h1>
            <a class="button add" href="./PostUser.php">Add User</a>
            <table>
                <thead>
                    <tr>
                        <th class="id">ID</th>
                        <th class="no">No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        foreach($users as $user) {
                            $i++;
                            echo '<tr>';
                            echo '<td class="id">'.$user['idUtilizator'].'</td>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$user['Nume'].'</td>';
                            echo '<td>'.$user['Prenume'].'</td>';
                            echo '<td>'.$user['Email'].'</td>';
                            echo '<td>';
                            echo '<a class="button edit" href="./PostUser.php?id='.$user['idUtilizator'].'">Edit</a>';
                            echo '<a class="button delete" href="/Proiect/Controllers/User/Delete.php?id='.$user['idUtilizator'].'">Delete</a>';
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