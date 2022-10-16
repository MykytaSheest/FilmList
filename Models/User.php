<?php

namespace Models;

use Core\Model;
use Core\View;
use lib\Codes;
use lib\Messages;

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

    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE email = :email';
        $data = $this->db->row($sql, ['email' => $email]);
        if (!empty($data)) {
            $user = new User();
            $user->id = $data[0]['id'];
            $user->email = $data[0]['email'];
            $user->password = $data[0]['password'];
            return $user;
        }
        return null;
    }
}
