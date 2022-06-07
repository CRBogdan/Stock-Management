<?php
    require_once 'Services/login_delegator.php';
    require_once 'Services/DepositService.php';
?>

<header>
    <link rel="stylesheet" href="/Proiect/Style/Header.css">
    <nav>
        <div>
            <a href="/Proiect/Index.php">
                <img src="/Proiect/Assets/logo.png" alt="">
            </a>
        </div>
        <div>
            <ul>
                <?php 
                    if(LoginDelegator::isLoggedIn()) {
                        if(LoginDelegator::isAdmin()) {
                            $headerDeposits = readDeposit("Activ = 1");

                            echo '<li class="stocSubmenu">';
                                echo '<span>Stocks</span>';
                                echo '<ul>';
                                    foreach($headerDeposits as $headerDeposit) {
                                        echo '<li class="stocItem"><a href="/Proiect/Pages/Stock/Stocks.php?id='.$headerDeposit['idDepozit'].'">'.$headerDeposit['Denumire'].'</a></li>';
                                    }
                                echo '</ul>';
                            echo '</li>';

                            echo '<li><a href="/Proiect/Pages/Transaction/Transactions.php">Transations</a></li>';
                            echo '<li><a href="/Proiect/Pages/Product/Products.php">Products</a></li>';
                            echo '<li><a href="/Proiect/Pages/Partner/Partners.php">Partners</a></li>';
                            echo '<li><a href="/Proiect/Pages/User/Users.php">Users</a></li>';
                            echo '<li><a href="/Proiect/Pages/Deposit/Deposits.php">Deposits</a></li>';
                        }
                        else if(LoginDelegator::isUser()) {
                            echo '<li><a href="/Proiect/Pages/Transaction/Transactions.php">Transations</a></li>';
                            echo '<li><a href="/Proiect/Pages/Stock/Stocks.php?id='.LoginDelegator::getIdDepozit().'">Stock</a></li>';
                        }
                        echo "<form action='/Proiect/Controllers/Login/Logout.php' method='post'>";
                        echo "<li><input class='logoutButton' type='submit' name='submit' value = 'Logout'/></li>";
                        echo '</form>';
                    }
                    else {
                        echo '<li><a href="/Proiect/Pages/Login/Login.php">Login</a></li>';
                    }
                 ?>
            </ul>
        </div>
    </nav>
</header>