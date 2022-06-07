<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/validator.php";
    require_once "$root/Services/DepositService.php";


    $deposit['idDepozit'] = $_POST['id'];
    $deposit['Activ'] = 1;
    $deposit['Denumire'] = $_POST['name'];
    $deposit['NrRegistrulComertului'] = $_POST['tradeNumber'];
    $deposit['CodFiscal'] = $_POST['fiscalCode'];
    $deposit['DenumireBanca'] = $_POST['bankName'];
    $deposit['ContIban'] = $_POST['ibanAccount'];
    $deposit['Oras'] = $_POST['city'];
    $deposit['Strada'] = $_POST['street'];
    $deposit['Numar'] = $_POST['number'];
    $deposit['Bloc'] = $_POST['block'];
    $deposit['Apartament'] = $_POST['apartment'];

    $data = [
        "Denumire" => $deposit['Denumire'],
        "NrRegistrulComertului" => $deposit['NrRegistrulComertului'],
        "CodFiscal" => $deposit['CodFiscal'],
        "DenumireBanca" => $deposit['DenumireBanca'],
        "ContIban" => $deposit['ContIban'],
        "Oras" => $deposit['Oras'],
        "Strada" => $deposit['Strada'],
        "Numar" => $deposit['Numar']
    ];

    $rules = [
        "Denumire" => ['required', 'min_len' => 6],
        "Oras" => ['required', 'min_len' => 3],
        "Strada" => ['required', 'min_len' => 3],
        "Numar" => ['required', 'min_len' => 1],
        "NrRegistrulComertului" => ['required', 'min_len' => 10],
        "CodFiscal" => ['required', 'min_len' => 6],
        "DenumireBanca" => ['required', 'min_len' => 5],
        "ContIban" => ['required', 'min_len' => 15]
    ];

    $validator = new Validator;
    if(validate($validator, $data, $rules)){
         $errors = $validator->getErrors();
    }

    if(isset($errors)){
        header("location: ../../Pages/Deposit/PostDeposit.php?".http_build_query(['errors' => $errors]));
        exit();
    }
    else{
        if($deposit['idDepozit'] != ""){
            updateDeposit($deposit, "idDepozit='".$deposit['idDepozit']."'");
        }
        else{
            createDeposit($deposit);
        }
        header("location: /Proiect/Pages/Deposit/Deposits.php");
    }

    function validate($validator, $data, $rules){
        $validator->validate($data, $rules);
        return $validator->hasErrors();
    }
?>