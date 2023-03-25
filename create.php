<!DOCTYPE html>
<html lang='fr-FR'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js' integrity='sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V' crossorigin='anonymous'></script>
    <title>Pokédex - Création de pokemon</title>
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
    $types = $typesManager->getAll();

    if ($_POST) {
        $number = $_POST['number'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $type1 = $_POST['type1'];
        $type2 = $_POST['type2'];

        if ($_FILE['image']['size'] < 2000000) {
            $imagesManager = new ImagesManager();
        }
    }

    ?>

    <main class='container'>
        <form method='POST' enctype='multipart/form-data'>
            <label for='number' class='form-label'>Numéro</label>
            <input type='number' name='number' id='number' placeholder='Le numéro du pokemon' class='form-control' min=1 max=901>

            <label for='name' class='form-label'>Nom</label>
            <input type='text' name='name' id='name' placeholder='Le nom du pokemon' class='form-control' minlength='3' maxlength='40'>

            <label for='description' class='form-label'>Description</label>
            <textarea rows='6' name='description' id='description' placeholder='La description du pokemon' class='form-control' minlength=10 maxlength=800></textarea>

            <label for='type1' class='form-label'>Type 1</label>
            <select name='type1' id='type1' class='form-select'>
                <?php foreach ($types as $type) : ?>
                    <option value='<?= $type->getId() ?>'><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <label for='type2' class='form-label'>Type 2</label>
            <select name='type2' id='type2' class='form-select'>
                <option value=''>--</option>
                <?php foreach ($types as $type) : ?>
                    <option value='<?= $type->getId() ?>'><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <label for='image' class='formFile'>Image</label>
            <input type='file' class='form-control' name='image' id='image'>
            <input type='submit' class='btn btn-success mt-3' value='Créer un pokemon'>
        </form>
</body>

</html>