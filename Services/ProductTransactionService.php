<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/conn.php";

    function createProductTransaction($data) {
        $conn = Database::getInstance();
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO produs_tranzactie ($columns) VALUES ('$values')";
        $conn->getConnection()->query($sql);
    }

    function readProductTransaction($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM produs_tranzactie";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function readProductsFromTransaction($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM produs_tranzactie LEFT JOIN produs ON produs_tranzactie.idProdus = produs.idProdus";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function updateProductTransaction($data, $where) {
        $conn = Database::getInstance();
        $columns = array_keys($data);
        $values = array_values($data);
        $sql = "UPDATE produs_tranzactie SET ";
        for($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " = '" . $values[$i] . "'";
            if($i < count($columns) - 1) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE $where";
        $conn->getConnection()->query($sql);
    }

    function deleteProductTransaction($where) {
        $conn = Database::getInstance();
        $sql = "DELETE FROM produs_tranzactie WHERE $where";
        $conn->getConnection()->query($sql);
    }

?>