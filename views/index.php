<main class='container'>
    <section class=' d-flex flex-wrap justify-content-center'>
        <?php foreach ($pokemons as $pokemon) :
        ?>

            <div class='card m-5' style='width: 18rem;'>
                <img src="<?= $imageManager->getImage($pokemon->getImageId())->getPath() ?>" class='card-img-top' alt='<?= $pokemon->getName() ?>'>
                <div class='card-body'>
                    <h5 class='card-title'><?= $pokemon->getNumber() ?># <?= $pokemon->getName() ?></h5>
                    <p class='card-text'><?= $pokemon->getDescription() ?></p>
                    <a href='update.php?id=<?= $pokemon->getId() ?>' class='btn btn-warning'>Modifier</a>
                    <a href='delete.php?id=<?= $pokemon->getId() ?>' class='btn btn-danger'>Supprimer</a>
                </div>
            </div>
        <?php endforeach ?>
    </section>

    <a href='create.php' class='btn btn-success'>Créer un pokemon</a>
</main>