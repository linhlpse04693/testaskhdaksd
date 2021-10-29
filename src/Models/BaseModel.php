<?php 

namespace Src\Models;

abstract class BaseModel {
    protected Database $db;

    protected string $table = '';

    protected array $fillable = [];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function all()
    {
        try {
            $this->db->query("SELECT * FROM $this->table");

            return $this->db->resultSet();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function get(int $id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function create(array $params)
    {
        $data = [];

        foreach ($this->fillable as $item) {
            $data[':' . $item] =  $params[$item] ?? null;
        }

        $this->db->query("INSERT INTO $this->table (" . implode(',', $this->fillable) . ") VALUES (" . implode(',', array_keys($data)) . ")");

        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->execute();
    }

    public function delete(int $id)
    {
        $this->db->query("DELETE FROM $this->table WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function update(int $id, array $params)
    {
        $fields = [];

        foreach ($params as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $this->db->query("UPDATE $this->table SET " . implode($fields) . " WHERE id = :id");
        $this->db->bind(':id', $id);
        foreach ($params as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        return $this->db->execute();
    }
}