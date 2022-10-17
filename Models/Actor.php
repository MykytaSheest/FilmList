<?php

namespace Models;

use Core\Model;

class Actor extends Model
{
    protected function getTableName(): string
    {
        return 'actors';
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . $this->getTableName() . ' (name) VALUES (:name)';
        $actor = $this->db->query(
            $sql,
            [
                'name' => $this->name,
            ],
            true,
        );
        return $actor;
    }

}
