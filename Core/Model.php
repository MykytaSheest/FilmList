<?php

namespace Core;

abstract class Model
{
    protected DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    /** @var int */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, string $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }


    public function findAll(): array|bool
    {
        return $this->db->row('SELECT * FROM ' . $this->getTableName() . ';');
    }

    public function delete(): \PDOStatement|string|bool
    {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = :id';
        $result = $this->db->query(
            $sql,
            [
                'id' => $this->getId(),
            ],
        );
        return $result;
    }

    public function getById(int $id): array|bool
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';
        return $this->db->row(
            $sql,
            [
                'id' => $id
            ]
        );
    }

    abstract protected function getTableName(): string;
}
