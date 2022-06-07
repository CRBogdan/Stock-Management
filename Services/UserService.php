<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/conn.php";

    function createUser($data) {
        $conn = Database::getInstance();
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO utilizator ($columns) VALUES ('$values')";
        $conn->getConnection()->query($sql);
    }

    function readUser($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM utilizator";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

    function updateUser($data, $where) {
        $conn = Database::getInstance();
        $columns = array_keys($data);
        $values = array_values($data);
        $sql = "UPDATE utilizator SET ";
        for($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " = '" . $values[$i] . "'";
            if($i < count($columns) - 1) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE $where";
        $conn->getConnection()->query($sql);
    }

    function deleteUser($where) {
        $conn = Database::getInstance();
        $sql = "DELETE FROM utilizator WHERE $where";
        $conn->getConnection()->query($sql);
    }

?>