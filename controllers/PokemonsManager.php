<?php

require_once './models/pokemon.php';

class PokemonsManager
{
    private PDO $db;

    public function __construct()
    {
        require 'db-connect.php';
    }

    public function create(Pokemon $pokemon)
    {
        $req = $this->db->prepare("INSERT INTO pokemon (number, name, description, type1, type2, image) VALUE (:number, :name, :description, :type1, :type2, :image)");

        $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(":name", $pokemon->getName(), PDO::PARAM_STR);
        $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":type1", $pokemon->getType1(), PDO::PARAM_INT);
        $req->bindValue(":type2", $pokemon->getType2(), PDO::PARAM_INT);
        $req->bindValue(":image", $pokemon->getImageId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function getPokemon(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM pokemon WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        // $req->execute([":id" => $id]); a verifier sinon on passe par la aussi image manager
        $data = $req->fetch();
        $pokemon = new pokemon($data);
        return $pokemon;
    }

    public function getAll(): array
    {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM pokemon ORDER BY number");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new pokemon($data);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    public function getAllByString(string $input)
    {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM pokemon WHERE name LIKE :input ORDER BY number");
        $req->bindValue(":input", $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new pokemon($data);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    public function getAllByType(string $input)
    {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM pokemon WHERE type1 OR type2 LIKE :input ORDER BY number");
        $req->bindValue(":input", $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new pokemon($data);
            $pokemons[] = $pokemon;
        }
    }

    public function update(Pokemon $pokemon)
    {
        $req = $this->db->prepare("UPDATE pokemon SET number =:number, name = :name, description = :description, type1 = :type1, type2 = :type2, image=:image");
        $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(":name", $pokemon->getName(), PDO::PARAM_STR);
        $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":type1", $pokemon->getType1(), PDO::PARAM_INT);
        $req->bindValue(":type2", $pokemon->getType2(), PDO::PARAM_INT);
        $req->bindValue(":image", $pokemon->getImageId(), PDO::PARAM_INT);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM pokemon where id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);

        $req->execute();
    }
}
