<h1>l'article demandé</h1>
<section class="show_article_section">
    <div id="article_by_id" class="container">
        <div class="articles_item">
            <div class="tof_and_desc">
                <div class="image_container">
                    <h1>image</h1>
                </div>
                <div class="text_items">
                    <h3>
                        <?= $article->getTitle() ?>
                    </h3>

                    <p class="description">
                        <?= $article->getDescription() ?>
                    </p>

                </div>
            </div>
        </div>

        <div class="commentaire">
            <h3>commentaires</h3>
            <?php foreach ($commentaries as $commentary) { ?>
            <div class="commentaire">
                <p> <?= $commentary->getContent() ?> </p>

                <div class="date_email_container">
                    <div class="publishdate"> <?= $commentary->getPublishDate() ?> </div>
                    <div class="hua">
                        <a href="#"><?= $data["authors"][$commentary->getAuthorId()] ?></a>
                    </div>


                    <?php if (isset($_SESSION["administrator_id"])) { ?>

                    <form action="/article/<?= $article->getId() ?>" method="POST">
                        <input type="hidden" name="commentary_id" value="<?= $commentary->getId() ?>">

                        <button type="submit" name="commentary-delete">supprimé</button>
                    </form>

                    <?php   } ?>

                </div>

            </div>
            <?php   } ?>
        </div>

    </div>

    <div class="add_commentary">
        <h3>Ajouter un commentaire</h3>
        <form class="form" action="/article/<?= $article->getId() ?>" method="post">

            <div class="champ"><label for="commentary">commentaire</label>
                <textarea name="commentary" id="commentary" placeholder="Entrez votre commentaire" required></textarea>
            </div>

            <!--  <div class="champ"><label for="publish_date">date de pub</label>
            <input type="date" name="publish_date" id="publish_date" required>
        </div> -->

            <button type="submit" class="form_button" name="add-commentary">commenter</button>
        </form>
    </div>
</section>
