<?php
if(isset($_POST['submit'])){
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    include "$root/Services/login_delegator.php";

    $login_data = [
        "email" => $_POST['username'],
        "password" => $_POST['password']
    ];

    $rules = [
        'email' => ['required', 'email', 'min_len' => 10],
        'password' => ['required', 'min_len' => 6]
    ];

    $loginDelegator = new LoginDelegator(new Validator, $rules);
    $loginDelegator->setData($login_data);
    try{
        $errors = $loginDelegator->login();
    }catch(Exception $e){
        $errors = [
            'error' => [$e->getMessage()],
        ];
    }
    
    if(isset($errors)){
        header("location: ../../Pages/Login/Login.php?".http_build_query($errors));
        exit();
    }   
    header("location: ../../index.php");
    exit();

}
header("location: ../../404.php");
exit();
?>