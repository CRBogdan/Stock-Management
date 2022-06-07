<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/login_delegator.php";
    require_once "$root/Services/UserService.php";
    require_once "$root/Services/DepositService.php";
    if(!(LoginDelegator::isAdmin())) {
        header("location: $root/404.php");
        exit();
    }
    if(isset($_GET['id'])) {
        $user = readUser('idUtilizator = '.$_GET['id'])->fetch_assoc();
    }else{
        $user = [];
        $user['Nume'] = '';
        $user['Prenume'] = '';
        $user['Email'] = '';
        $user['Parola'] = '';
        $user['idUtilizator'] = '';
        $user['idRol'] = '';
        $user['DataNastere'] = '';
        $user['Telefon'] = '';
    }
    if(isset($_GET['errors'])) {
        $errors = $_GET['errors'];
    }
    $deposits = readDeposit();
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
            <h1>Edit User</h1>
            <form action="/Proiect/Controllers/User/Update.php" method="POST">
                <div class="formWraper">
                    <input type="hidden" name="id" value="<?php echo $user['idUtilizator'] ?>">
                    <div class="formGroup">
                        <label for="Nume">First Name</label>
                        <input type="text" name="Nume" id="Nume" value="<?php echo $user['Nume'] ?>">
                        <?php if(isset($errors['nume'])) {
                                foreach($errors['nume'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="Prenume">Last Name</label>
                        <input type="text" name="Prenume" id="Prenume" value="<?php echo $user['Prenume'] ?>">
                        <?php if(isset($errors['prenume'])) {
                                foreach($errors['prenume'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="Email">Email</label>
                        <input type="email" name="Email" id="Email" value="<?php echo $user['Email'] ?>">
                        <?php if(isset($errors['email'])) {
                                foreach($errors['email'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <?php
                                if($user['idRol'] == "") {
                                    echo '<option value="1" selected>Select a role</option>';
                                }
                            ?>
                            <option <?php if($user["idRol"]==1) echo " selected " ?>value="1">Admin</option>
                            <option <?php if($user["idRol"]==2) echo " selected " ?>value="2">User</option>
                        </select>
                    </div>
                    <div class="formGroup">
                        <label for="idDepozit">Deposit</label>
                        <select name="idDepozit" id="idDepozit">
                            <?php
                                if($user['idDepozit'] == "") {
                                    echo '<option value="1" selected>Select a deposit</option>';
                                }
                            ?>

                            <?php
                            foreach($deposits as $deposit) {
                                    if($user['idDepozit'] == $deposit['idDepozit']) {
                                        echo '<option value="'.$deposit['idDepozit'].'" selected>'.$deposit['Denumire'].'</option>';
                                    }else{
                                        echo '<option value="'.$deposit['idDepozit'].'">'.$deposit['Denumire'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="formGroup">
                        <label for="Telefon">Phone</label>
                        <input type="text" name="Telefon" id="Telefon" value="<?php echo $user['Telefon'] ?>">
                        <?php if(isset($errors['telefon'])) {
                                foreach($errors['telefon'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="DataNastere">Birth Date</label>
                        <input type="date" name="DataNastere" id="DataNastere"
                            value="<?php echo $user['DataNastere'] ?>">
                        <?php if(isset($errors['dataNastere'])) {
                                foreach($errors['dataNastere'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="Parola">Password</label>
                        <input type="password" name="Parola" id="Parola">
                        <?php if(isset($errors['parola'])) {
                                foreach($errors['parola'] as $error) {
                                    echo '<p class="error">'.$error.'</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="formGroup">
                        <label for="passwordConfirmation">Password Confirmation</label>
                        <input type="password" name="passwordConfirmation" id="passwordConfirmation">
                        <?php if(isset($errors['passwordConfirmation'])) {
                                foreach($errors['passwordConfirmation'] as $error) {
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