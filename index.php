<?php

require './controllers/PokemonsManager.php';
$manager = new PokemonsManager();
require './controllers/ImagesManager.php';
$imageManager = new ImagesManager();
$pokemons = $manager->getAll();


$title = "Pokedex - Accueil";

include './Layout/header.php';

include './views/index.php';

include './Layout/footer.php';
