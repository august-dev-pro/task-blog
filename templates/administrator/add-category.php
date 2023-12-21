<!-- categorie section -->
<section class="categorie_add_section">
    <div class="containe">
        <div class=""><?php require_once 'bar-nar-header.php' ?></div>
        <div class="categorie_add_section_content">
            <div class="">
                <?php require_once 'nav-bar.php' ?>
            </div>
            <div class="categorie_add_form">
                <h1>Ajouter une categorie</h1>
                <form class="form" action="/administration/add-categorie" method="post">
                    <?php if (!is_null($error)) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php } ?>
                    <?php if (!is_null($succes)) { ?>
                        <span class="succes"><?= $succes ?></span>
                    <?php } ?>
                    <div class="champ">
                        <label for="name">Nomez la categorie</label>
                        <input type="text" name="name" id="name" required>

                    </div>
                    <button class="form_button" type="submit" name="add-categorie">Ajouter</button>
                </form>
            </div>

        </div>
    </div>

</section>
