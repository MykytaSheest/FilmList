<?php

namespace Models;

use Core\Model;

class Format extends Model
{
    protected function getTableName(): string
    {
        return 'formats';
    }

    public function getFormatById(): string
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';
        $data = $this->db->row($sql, ['id' => $this->id]);
        return $data[0]['title'];
    }
}
