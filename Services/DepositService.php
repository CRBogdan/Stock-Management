<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/conn.php";

    function createDeposit($data) {
        $conn = Database::getInstance();
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO depozit ($columns) VALUES ('$values')";
        $conn->getConnection()->query($sql);
    }

    function readDeposit($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM depozit";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function updateDeposit($data, $where) {
        $conn = Database::getInstance();
        $columns = array_keys($data);
        $values = array_values($data);
        $sql = "UPDATE depozit SET ";
        for($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " = '" . $values[$i] . "'";
            if($i < count($columns) - 1) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE $where";
        $conn->getConnection()->query($sql);
    }

    function deleteDeposit($where) {
        $conn = Database::getInstance();
        $sql = "DELETE FROM depozit WHERE $where";
        $conn->getConnection()->query($sql);
    }

?>