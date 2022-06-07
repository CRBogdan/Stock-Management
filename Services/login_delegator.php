<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
session_start();
require_once 'conn.php';
require_once "$root/Services/validator.php";

class LoginDelegator{
    private Validator $validator;
    private $conn;
    private array $data;
    private array $rules = [
        'email' => ['required'],
        'password' => ['required']
    ];

    function __construct(Validator $validator, array $rules = null ){
        $this->conn = Database::getInstance()->getConnection();
        $this->validator = $validator;
        
        if($rules !== null)
            $this->rules = $rules;
    }  
    
    private function validate(){
        $this->validator->validate($this->data, $this->rules);   
        return $this->validator->hasErrors();
    }

    public function setData(array $data){
        $this->data= $data;
    }

    public function login(){
        if($this->validate()){
            return $this->validator->getErrors();
        }

        try {
            $this->attemptLogin();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            throw $th;
        }
    }

    private function attemptLogin(){
        $sql = "SELECT * FROM utilizator WHERE `Email` = ? ";
        if(! ($stmt = $this->conn->prepare($sql)))
            $this->throwError("1Oops! Something went wrong. Please try again later.",502);
        
        $stmt->bind_param("s", $param_email);
        $param_email = $this->data['email'];

        if(!$stmt->execute())
            $this->throwError("2Oops! Something went wrong. Please try again later.",502);
        
        $stmt->store_result();
        
        if($stmt->num_rows != 1)
            $this->throwError("Invalid email or password. name");
        
        $stmt->bind_result($idUtilizator, $idDepozit, $idRol, $Nume, $Prenume, $Email, $Parola, $DataNastere, $Telefon);

        if($stmt->fetch()){
            if(hash("sha256",$this->data['password']) != $Parola)
                $this->throwError("Invalid username or password.");

            $_SESSION["logged_in"] = true;
            $_SESSION["id"] = $idUtilizator;
            $_SESSION["email"] = $email;   
            $_SESSION['role_id'] = $idRol;    
            $_SESSION['depozit_id'] = $idDepozit;
        }
        $stmt->close();
    }

    public function logout(){
        session_destroy();
    }

    private function throwError($message, $code = 400){
        throw new Exception($message,$code);
    }

    public static function isLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }

    public static function isAdmin(){
        return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
    }

    public static function isUser(){
        return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2;
    }

    public static function getIdDepozit(){
        return $_SESSION['depozit_id'];
    }
}
