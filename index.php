<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>Pokédex</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <image src="./image/pokeball logo.png" alt="Un logo de pokeball" width="60"></image>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    require_once 'PokemonsManager.php';
    $manager = new PokemonsManager();
    $pokemons = $manager->getAll();

    ?>

    <main class="container">
        <section class=" d-flex flex-wrap justify-content-center">
            <?php foreach ($pokemons as $pokemon) :

            ?>
                <div class="card m-5" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="<?= $pokemon->getName() ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $pokemon->getNumber() ?># <?= $pokemon->getName() ?></h5>
                        <p class="card-text"><?= $pokemon->getDescription() ?></p>
                        <a href="#" class="btn btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= $pokemon->getId() ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endforeach ?>
        </section>

        <a href="create.php" class="btn btn-success">Créer un pokemon</a>
    </main>
</body>

</html>