<h1>Ajouter une Image</h1>
<form class="form" action="/image_uploaded" method="post" enctype="multipart/form-data">
    <?php if (!is_null($error)) { ?>
        <span class="error"><?= $error ?></span>
    <?php } ?>
    <?php if (!is_null($succes)) { ?>
        <span class="succes"><?= $succes ?></span>
    <?php } ?>
    <div class="champ">
        <label for="image">Ajoutez un fichier</label>
        <input type="file" name="image">
    </div>
    <button class="form_button" type="submit">Envoyeer</button>
</form>
