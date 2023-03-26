<?php

require_once 'PokemonsManager.php';

$pokemonManager = new PokemonsManager();

try {
    $pokemonManager->delete($_GET['id']);
} catch (Exception $e) {
    $e->getMessage();
}

header('Location : ./index.php');
