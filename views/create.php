<main class="container">

    <?php if ($error !== '') {
        echo '<p class="alert alert-danger"' . $error . '</p>';
    } ?>
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
            <option value='null'>--</option>
            <?php foreach ($types as $type) : ?>
                <option value='<?= $type->getId() ?>'><?= $type->getName() ?></option>
            <?php endforeach ?>
        </select>

        <label for='image' class='formFile'>Image</label>
        <input type='file' class='form-control' name='image' id='image'>
        <input type='submit' class='btn btn-success mt-3' value='Créer un pokemon'>
    </form>
</main>