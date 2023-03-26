<!DOCTYPE html>
<html lang='fr-FR'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js' integrity='sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V' crossorigin='anonymous'></script>
    <title>Pokédex - Modifier un pokemon</title>
</head>

<body>
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='index.php'>
                <image src='./image/pokeball logo.png' alt='Un logo de pokeball' width='60'></image>
            </a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    <li class='nav-item'>
                        <a class='nav-link active' aria-current='page' href='index.php'>Acceuil</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Types</a>
                    </li>
                </ul>
                <form class='d-flex'>
                    <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search'>
                    <button class='btn btn-outline-success' type='submit'>Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    require_once 'PokemonsManager.php';
    require_once 'TypesManager.php';
    require_once 'ImagesManager.php';

    $pokemonManager = new PokemonsManager();
    $typesManager = new TypesManager();
    $imagesManager = new ImagesManager();

    $pokemon = $pokemonManager->getPokemon($_GET['id']);
    $types = $typesManager->getAll();
    $error = '';

    try {
        if ($_POST) {
            $number = $_POST['number'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $type1 = $_POST['type1'];
            $type2 = $_POST['type2'] === 'null' ? null : $_POST['type2'];

            if ($number < 1 || $number > 901 || strlen($name) < 4 || strlen($name) > 40 || strlen($description) < 10 || strlen($description) > 200 || $type1 < 1 || $type1 > 25) {
                throw new Exception('Les données saisies ne sont pas correctes');
            } else {
                try {
                    if ($_FILES['image']['size'] < 2000000) {
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
            $pokemonManager->update($newPokemon);
            header('Location: ./index.php');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    ?>

    <main class='container'>
        <?php if ($error !== '') {
            echo "<p class=\"alert alert-danger mt-3\"> $error </p>";
        } ?>
        <form method='POST' enctype='multipart/form-data'>
            <label for='number' class='form-label'>Numéro</label>
            <input type='number' min=1 max=1000 name='number' value="<?= $pokemon->getNumber() ?>" id='number' placeholder='Le numéro du pokemon' class='form-control' min=1 max=901>

            <label for='name' class='form-label'>Nom</label>
            <input type='text' minlength="4" maxlength="40" name='name' value="<?= $pokemon->getName() ?>" id='name' placeholder='Le nom du pokemon' class='form-control' minlength='3' maxlength='40'>

            <label for='description' class='form-label'>Description</label>
            <textarea rows='6' name='description' id='description' placeholder='La description du pokemon' class='form-control' minlength=10 maxlength=800><?= $pokemon->getDescription() ?></textarea>

            <label for='type1' class='form-label'>Type 1</label>
            <select name='type1' id='type1' class='form-select'>
                <?php foreach ($types as $type) : ?>
                    <option <?= $type->getId() === $pokemon->getType1() ?? "selected" ?> value='<?= $type->getId() ?>'><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <label for='type2' class='form-label'>Type 2</label>
            <select name='type2' id='type2' class='form-select'>
                <option value='null'>--</option>
                <?php foreach ($types as $type) : ?>
                    <option <?= $type->getId() === $pokemon->getType2() ?? "selected" ?> value='<?= $type->getId() ?>'><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <br />
            <label for='image' class='formFile'>Image</label>
            <input type='file' required class='form-control' name='image' id='image'>

            <image class="my-3 w-25 " src="<?= $imagesManager->getImage($pokemon->getImageId())->getPath() ?>" alt="<?php $pokemon->getName() ?>">
            </image>
            <br />
            <input type='submit' class='btn btn-warning my-3' value='Modifier le pokemon'>
        </form>
</body>

</html>