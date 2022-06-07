<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="/Proiect/Style/Style.css">
    <title>Document</title>
</head>
<body class="background">
    <?php include "$root/Header.php"; ?>

    <main class="login">
        <form action="../../Controllers/Login/Login.php" method="post">
            <div>
                <label for="username">Email</label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <?php
                $errors = $_GET;
                foreach ($errors as $key => $error) {
                    echo "<ul class='error' style='color:red; list-style-type:none;'>";
                    foreach ($error as $value) {
                        echo "<li>$value</li>";
                    }
                    echo "</ul>";
                }
            ?>
            <div>
                <button type="submit" name="submit" >Login</button>
            </div>
        </form>
    </main>
</body>
</html>