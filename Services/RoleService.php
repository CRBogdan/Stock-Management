<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/Proiect';
    require_once "$root/Services/conn.php";

    function readRole($where = null) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM rol";
        if($where != null) {
            $sql .= " WHERE $where";
        }
        $result = $conn->getConnection()->query($sql);
        return $result;
    }

?>