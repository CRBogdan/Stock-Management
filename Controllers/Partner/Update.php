<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/validator.php";
    require_once "$root/Services/PartnerService.php";


    $partner['idPartener'] = $_POST['id'];
    $partner['Activ'] = 1;
    $partner['Denumire'] = $_POST['name'];
    $partner['NrRegistrulComertului'] = $_POST['tradeNumber'];
    $partner['CodFiscal'] = $_POST['fiscalCode'];
    $partner['DenumireBanca'] = $_POST['bankName'];
    $partner['ContIban'] = $_POST['ibanAccount'];
    $partner['Oras'] = $_POST['city'];
    $partner['Strada'] = $_POST['street'];
    $partner['Numar'] = $_POST['number'];
    $partner['Bloc'] = $_POST['block'];
    $partner['Apartament'] = $_POST['apartment'];

    $data = [
        "Denumire" => $partner['Denumire'],
        "NrRegistrulComertului" => $partner['NrRegistrulComertului'],
        "CodFiscal" => $partner['CodFiscal'],
        "DenumireBanca" => $partner['DenumireBanca'],
        "ContIban" => $partner['ContIban'],
        "Oras" => $partner['Oras'],
        "Strada" => $partner['Strada'],
        "Numar" => $partner['Numar']
    ];

    $rules = [
        "Denumire" => ['required', 'min_len' => 6],
        "Oras" => ['required', 'min_len' => 3],
        "Strada" => ['required', 'min_len' => 3],
        "Numar" => ['required', 'min_len' => 1],
        "NrRegistrulComertului" => ['required', 'min_len' => 10],
        "CodFiscal" => ['required', 'min_len' => 6],
        "DenumireBanca" => ['required', 'min_len' => 5],
        "ContIban" => ['required', 'min_len' => 6]
    ];

    $validator = new Validator;
    if(validate($validator, $data, $rules)){
         $errors = $validator->getErrors();
    }

    if(isset($errors)){
        header("location: ../../Pages/Partner/PostPartner.php?".http_build_query(['errors' => $errors]));
        exit();
    }
    else{
        if($partner['idPartener'] != ""){
            updatePartner($partner, "idPartener='".$partner['idPartener']."'");
        }
        else{
            createPartner($partner);
        }
        header("location: /Proiect/Pages/Partner/Partners.php");
    }

    function validate($validator, $data, $rules){
        $validator->validate($data, $rules);
        return $validator->hasErrors();
    }
?>