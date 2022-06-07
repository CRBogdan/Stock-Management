<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/validator.php";
    require_once "$root/Services/UserService.php";

    $user['idUtilizator'] = $_POST['id'];
    $user['Nume'] = $_POST['Nume'];
    $user['Prenume'] = $_POST['Prenume'];
    $user['Email'] = $_POST['Email'];
    $user['idRol'] = $_POST['role'];
    $user['Telefon'] = $_POST['Telefon'];
    $user['DataNastere'] = $_POST['DataNastere'];
    $user['Parola'] = $_POST['Parola'];
    $user['idDepozit'] = $_POST['idDepozit'];
    $passwordConfirm = $_POST['passwordConfirmation'];

    $data = [
        "nume" => $user['Nume'],
        "prenume" => $user['Prenume'],
        "email" => $user['Email'],
        "telefon" => $user['Telefon'],
        "dataNastere" => $user['DataNastere'],
        "parola" => $user['Parola']
    ];

    $rules = [
        'email' => ['required', 'email', 'min_len' => 10],
        'parola' => ['required', 'min_len' => 6],
        'nume' => ['required' , 'min_len' => 2],
        'prenume' => ['required', 'min_len' => 2],
        'telefon' => ['required', 'min_len' => 10],
        'dataNastere' => ['required']
    ];

    $validator = new Validator;
    if(validate($validator, $data, $rules)){
         $errors = $validator->getErrors();
    }
    if($user["Parola"] != $passwordConfirm){
        if(!isset($errors)){
            $errors = [];
        }
        $errors['passwordConfirmation'] = ['Password and password confirmation do not match.'];
    }

    $userExists = readUser("Email ='". $user['Email']."'");
    if($userExists->num_rows > 0 && $user['idUtilizator'] == ""){
        if(!isset($errors)){
            $errors = [];
        }
        $errors['email'] = ['Email already exists.'];
    }

    if(isset($errors)){
        header("location: ../../Pages/User/PostUser.php?".http_build_query(['errors' => $errors]));
        exit();
    }
    else{
        if($user['idUtilizator']!=""){
            $user['Parola'] = hash("sha256",$user['Parola']);
            updateUser($user, "idUtilizator='".$user['idUtilizator']."'");
        }
        else{
            $user['Parola'] = hash("sha256",$user['Parola']);
            createUser($user);
        }
        header("location: ../../Pages/User/Users.php");
    }

    function validate($validator, $data, $rules){
        $validator->validate($data, $rules);
        return $validator->hasErrors();
    }
?>