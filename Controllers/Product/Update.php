<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/validator.php";
    require_once "$root/Services/ProductService.php";


    $product['idProdus'] = $_POST['id'];
    $product['Activ'] = 1;
    $product['Serial'] = $_POST['serial'];
    $product['Brand'] = $_POST['brand'];
    $product['Model'] = $_POST['model'];
    $product['Pret'] = $_POST['price'];
    $product['Descriere'] = $_POST['description'];

    $data = [
        'Serial' => $product['Serial'],
        "Brand" => $product['Brand'],
        "Model" => $product['Model'],
        "Price" => $product['Pret'],
        "Description" => $product['Descriere']
    ];

    $rules = [
        "Serial" => ["required"],
        "Brand" => ["required", "min_len" => 2],
        "Model" => ["required"],
        "Price" => ["required", "numeric"],
        "Description" => ["required"]
    ];

    $validator = new Validator;
    if(validate($validator, $data, $rules)){
         $errors = $validator->getErrors();
    }

    if(isset($errors)){
        header("location: ../../Pages/Product/PostProduct.php?".http_build_query(['errors' => $errors]));
        exit();
    }
    else{
        if($product['idProdus'] != ""){
            updateProduct($product, "idProdus='".$product['idProdus']."'");
        }
        else{
            createProduct($product);
        }
        header("location: /Proiect/Pages/Product/Products.php");
    }

    function validate($validator, $data, $rules){
        $validator->validate($data, $rules);
        return $validator->hasErrors();
    }
?>