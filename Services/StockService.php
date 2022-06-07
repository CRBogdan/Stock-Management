<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/conn.php";

    function createStock($data) {
        $conn = Database::getInstance();
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO stoc ($columns) VALUES ('$values')";
        $conn->getConnection()->query($sql);
    }

    function readStock($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM stoc";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function readDeposit_Stock_Product($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM stoc INNER JOIN depozit ON stoc.idDepozit = depozit.idDepozit INNER JOIN produs ON stoc.idProdus = produs.idProdus";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function updateStock($data, $where) {
        $conn = Database::getInstance();
        $columns = array_keys($data);
        $values = array_values($data);
        $sql = "UPDATE stoc SET ";
        for($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " = '" . $values[$i] . "'";
            if($i < count($columns) - 1) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE $where";
        $conn->getConnection()->query($sql);
    }

    function deleteStock($where) {
        $conn = Database::getInstance();
        $sql = "DELETE FROM stoc WHERE $where";
        $conn->getConnection()->query($sql);
    }

?>