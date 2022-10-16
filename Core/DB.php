<?php

namespace Core;

use PDO;

class DB
{
    private PDO $db;

    public function __construct()
    {
        $config = require 'Configs/db.php';
        $this->db = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['database'],
            $config['username'],
            $config['password'],
        );
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindParam(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}
