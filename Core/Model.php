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

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public function findAll()
    {
        return $this->db->row('SELECT * FROM ' . $this->getTableName() . ';');
    }

    abstract protected function getTableName(): string;
}
