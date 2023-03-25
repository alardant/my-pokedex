<?php

require_once 'PokemonsManager.php';

$pokemonManager = new PokemonsManager();
$pokemonManager->delete($_GET['id']);

header('Location : ./index.php');
