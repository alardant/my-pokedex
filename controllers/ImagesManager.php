<?php

require_once './models/Image.php';

class ImagesManager
{
    private PDO $db;

    public function __construct()
    {
        require 'db-connect.php';
    }


    public function create(Image $image)
    {
        $req = $this->db->prepare('INSERT INTO image (name, path) VALUE (:name, :path)');

        $req->bindValue(':name', $image->getName(), PDO::PARAM_STR);
        $req->bindValue(':path', $image->getPath(), PDO::PARAM_STR);

        $req->execute();
    }

    public function getImage(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `image` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        // $req->execute([":id" => $id]); A verifier sinon on passe par la aussi pokemons manager
        $data = $req->fetch();
        $image = new Image($data);
        return $image;
    }

    public function getLastImageId()
    {
        $req = $this->db->query('SELECT * FROM image ORDER BY id DESC LIMIT 1');
        $image = $req->fetch()['id'];
        return $image;
    }

    public function update(Image $image)
    {
        $req = $this->db->prepare('UPDATE image SET name = :name, path = :path');
        $req->bindValue(':name', $image->getName(), PDO::PARAM_STR);
        $req->bindValue(':path', $image->getPath(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare('DELETE FROM image where id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}
