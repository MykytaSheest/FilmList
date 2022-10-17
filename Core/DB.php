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

    public function query($sql, $params = [], bool $getId = false): \PDOStatement|string|bool
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        if ($getId == true) {
            return $this->db->lastInsertId();
        }
        return $stmt;
    }

    public function row($sql, $params = []): array|bool
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []): mixed
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}
