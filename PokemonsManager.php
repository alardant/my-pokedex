<?php

class PokemonsManager
{
    private $db;

    public function __construct()
    {
        $dbName = 'my-pokedex';
        $port = 3306;
        $username = 'root';
        $password = ''; // vérifier si le mot de passe march

        try {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port, $username, $password");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create(Pokemon $pokemon)
    {
        $req = $this->db->prepare("INSER INTO pokemon (numero, name, description, type1, type2) VALUE (:number, :name, :description, :type1, :type2)");

        $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(":name", $pokemon->getName(), PDO::PARAM_STR);
        $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":type1", $pokemon->getType1(), PDO::PARAM_STR);
        $req->bindValue(":type2", $pokemon->getType2(), PDO::PARAM_INT);

        $req->execute();
    }

    public function getPokemon(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM pokemon WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $data = $req->fetch();
        $pokemon = new pokemon($data);
        return $pokemon;
    }

    public function getAll()
    {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM pokemon ORDER BY numero");
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
        $req = $this->db->query("SELECT * FROM pokemon WHERE name LIKE :input ORDER BY numero");
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
        //if($input instanceof Type)
    }

    public function update(Pokemon $pokemon)
    {
    }

    public function delete(int $id)
    {
    }
}
