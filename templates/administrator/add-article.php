<div class="">
    <div class="containe">
        <div class=""><?php require_once 'bar-nar-header.php' ?></div>
        <section class="article_add_form_section">
            <div class="">
                <?php require_once 'nav-bar.php' ?>
            </div>
            <div class="article_add_form">
                <h1>Ajouter un article</h1>
                <form class="form" action="/administration/add-article" method="POST" enctype="multipart/form-data">
                    <?php if (!is_null($error)) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php } ?>
                    <?php if (!is_null($succes)) { ?>
                        <span class="succes"><?= $succes ?></span>
                    <?php } ?>

                    <div class="champ">
                        <label for="title">Entrez le titre*</label>
                        <input type="text" name="title" id="title" placeholder="Entrez le titre" required>
                    </div>

                    <div class="champ">
                        <label for="excerpt">Entrez la description*</label>
                        <textarea name="excerpt" id="excerpt" placeholder="Entrez la description" required></textarea>
                    </div>

                    <div class="champ">
                        <label for="content">Entrez le contenu*</label>
                        <textarea name="content" id="content" placeholder="Entrez le contenu" required></textarea>
                    </div>

                    <div class="champ">
                        <label for="file">Ajouter des images</label>
                        <input type="file" name="file" id="file" required>
                    </div>

                    <div class="champ">
                        <select name="categorie_id" class="form-select" aria-label="Default select example" required>
                            <option selected>Choisisez la categorie </option>
                            <?php foreach ($categories as $categorie) { ?>
                                <option value="<?= $categorie->getId() ?>"> <?= $categorie->getName() ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="champ">
                        <input type="hidden" name="author_id" value="<?= $_SESSION["user"]["id"] ?>">
                    </div>

                    <div class="champ">
                        <input type="checkbox" name="published">
                        <label for="publish"> Publié ?</label>
                    </div>

                    <button class="form_button" type="submit" name="add-article">Ajouter</button>
                </form>
            </div>
    </div>
</div>
</div>
