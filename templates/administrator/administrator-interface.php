<main class="all_container">
    <!--Articles section-->

    <section class="articles_section">
        <div class="containe">
            <div class="articles_section_content">
                <div class="nav_header_inclu">
                    <?php require_once 'bar-nar-header.php' ?>
                </div>
                <div class="articles_content_container">
                    <div class="nar_included">
                        <?php require_once 'nav-bar.php' ?>
                    </div>
                    <div class="articles">
                        <h1>Les articles</h1>
                        <div class="articles_content">
                            <?php foreach ($articles as $article) { ?>
                                <div class="articles_item">
                                    <h3>
                                        <?= $article->getTitle() ?>
                                    </h3>
                                    <p class="description">
                                        <?= $article->getDescription() ?>
                                    </p>
                                    <form action="/administration" method="POST">
                                        <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
                                        <button id="delete_btn" class="form_button" type="submit" name="delete-by-id">Supprimer</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
    <!-- aaaaaaaaaaa -->


    <!-- end categorie -->
</main>
