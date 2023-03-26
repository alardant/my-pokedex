<main class="container">

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
</main>