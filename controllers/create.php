<?php

require_once 'PokemonsManager.php';
require_once 'TypesManager.php';
require_once 'ImagesManager.php';

$pokemonManager = new PokemonsManager();
$typesManager = new TypesManager();
$types = $typesManager->getAll();
$error = '';

if ($_POST) {
    $number = $_POST['number'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'] === 'null' ? null : $_POST['type2'];

    try {
        if ($_FILES['image']['size'] < 2000000) {
            $imagesManager = new ImagesManager();
            $fileName = $_FILES['image']['name'];
            if (!is_dir('upload/')) {
                mkdir('upload/');
            }
            $filePath = 'upload/' . $fileName;
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            // A verifier en fin de projet avec mimetype
            define('EXTENSIONS', ['png', 'jpeg', 'jpg', 'webp']);

            if (in_array(strtolower($fileExtension), EXTENSIONS)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $image = new Image(['name' => $fileName, 'path' => $filePath]);
                    $imagesManager->create($image);
                } else {
                    throw new Exception('Une erreur est survenue');
                }
            } else {
                throw new Exception('L\'extension du fichier n\est pas supportée');
            }
        } else {
            throw new Exception('Le fichier ne doit pas dépasser 2 Go');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $imageId = $imagesManager->getLastImageId();
    $newPokemon = new Pokemon([
        'number' => $number,
        'name' => $name,
        'description' => $description,
        'type1' => $type1,
        'type2' => $type2,
        'image' => $imageId
    ]);
    $pokemonManager->create($newPokemon);
    header('Location: ./index.php');
}
