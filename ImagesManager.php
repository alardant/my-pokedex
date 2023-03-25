<?php

require_once 'Image.php';

class ImagesManager
{
    private PDO $db;

    public function __construct()
    {
        $dbName = 'my-pokedex';
        $port = 3306;
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port, $username, $password");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create(Image $image)
    {
        $req = $this->db->prepare("INSERT INTO image (name, path) VALUE (:name, :path)");

        $req->bindValue(":name", $image->getName(), PDO::PARAM_STR);
        $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);

        $req->execute();
    }

    public function getImage(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM image WHERE id = :id');
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $images = $req->fetchAll();
        return $images[0];
    }

    public function getLastImageId()
    {
        $req = $this->db->query("SELECT * FROM image ORDER BY id DESC LIMIT 1");
        $image = $req->fetch()['id'];
        return $image;
    }

    public function update(Image $image)
    {
        $req = $this->db->prepare("UPDATE image SET name = :name, path = :path");
        $req->bindValue(":name", $image->getName(), PDO::PARAM_STR);
        $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM image where id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);

        $req->execute();
    }
}
