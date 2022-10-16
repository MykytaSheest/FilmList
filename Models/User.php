<?php

namespace Models;

use Core\Model;

class User extends Model
{
    protected function getTableName(): string
    {
        return 'users';
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . $this->getTableName() . ' (email, password) VALUES (:email, :password)';
        $user = $this->db->query(
            $sql,
            [
                'email' => $this->email,
                'password' => $this->password
            ]
        );
        return $user;
    }
}
