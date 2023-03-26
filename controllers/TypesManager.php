<?php

require_once './models/Type.php';

class TypesManager
{
    private PDO $db;

    public function __construct()
    {
        require 'db-connect.php';
    }

    public function create(Type $type)
    {
        $req = $this->db->prepare('INSER INTO type (name, color) VALUE (:name, :color)');

        $req->bindValue(':name', $type->getName(), PDO::PARAM_STR);
        $req->bindValue(':color', $type->getColor(), PDO::PARAM_STR);

        $req->execute();
    }

    public function getType(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM type WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $data = $req->fetch();
        $type = new Type($data);
        return $type;
    }

    public function getAll(): array
    {
        $types = [];
        $req = $this->db->query('SELECT * FROM type ORDER BY name');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $type = new Type($data);
            $types[] = $type;
        }
        $req->closeCursor();
        return $types;
    }

    public function getAllByString(string $input)
    {
        $types = [];
        $req = $this->db->query('SELECT * FROM type WHERE name LIKE :input ORDER BY number');
        $req->bindValue(':input', $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $type = new Type($data);
            $types[] = $type;
        }
        return $types;
    }

    public function getAllByType(string $input)
    {
        $types = [];
        $req = $this->db->query('SELECT * FROM type WHERE type1 OR type2 LIKE :input ORDER BY number');
        $req->bindValue(':input', $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $type = new type($data);
            $types[] = $type;
        }
    }


    public function update(Type $type)
    {
        $req = $this->db->prepare('UPDATE type SET name = :name, color = :color');
        $req->bindValue(':name', $type->getName(), PDO::PARAM_STR);
        $req->bindValue(':color', $type->getColor(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare('DELETE FROM type where id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}
