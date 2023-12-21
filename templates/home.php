<main class="body_all">
    <section class="baner_slider_section">
        <div class="containe">
            <div class="">
                <div class="slider silider_content">
                    <div class="slide">
                        <img id="image1" src="../images/image1.webp" alt="Image 1">
                    </div>
                    <div class="slide">
                        <img id="image1" src="../images/image2.jpg" alt="Image 2">
                    </div>
                    <div class="slide">
                        <img id="image1" src="../images/image3.jpg" alt="Image 3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home_body_section">

        <div class="containe">
            <div class="home_body">
                <div class="search_container">
                    <section class="searsh_section">
                        <div class="search_bar_title">
                            <h3> Rechercher des Articles</h3>
                        </div>
                        <form class="form" method="GET" action="/search">
                            <div class="champ">
                                <input type="text" name="q" id="searchInput" placeholder="Rechercher des articles">
                                <input class="form_button" type="submit" value="Rechercher">
                            </div>
                        </form>
                    </section>
                </div>
                <div class="home_body_content">
                    <section class="categorie_section">
                        <div class="nav_bar_section">
                            <div class="nav_bar_content">
                                <div style="/*height: auto; width: auto;*/" class="nav_bar">
                                    <div class="nav_bar_title">
                                        <div class="title"> <a href="/">CATEGORIES</a></div>
                                    </div>
                                    <!-- affichage des categorie -->
                                    <div class="nav_childs_container">
                                        <?php foreach ($categories as $key => $categorie) { ?>
                                        <div class="nav_child">
                                            <a href="/categorie/<?= $categorie->getId() ?>">
                                                <?= $categorie->getName() ?>
                                            </a>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="articles_section">

                        <!-- Formulaire de recherche -->

                        <div class="articles_section_content">
                            <h1>Les articles</h1>
                            <div class="articles_container">
                                <?php foreach ($articles as $article) { ?>
                                <div class="container">

                                    <div class="articles_item">
                                        <div class="tof_and_desc">
                                            <div class="image_container">
                                                <div class="article_desc">
                                                    <img src="<?= "../images/" . $article->getFiles() ?>"
                                                        alt="Image de l'article">
                                                </div>
                                            </div>
                                            <div class="text_items">
                                                <h3>
                                                    <?= $article->getTitle() ?>

                                                </h3>

                                                <p class="description">
                                                    <?= $article->getDescription() ?>
                                                </p>

                                                <h1> <?= $article->getCommentariesNumber() ?></h1>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="hue">
                                                <?= $data["number"][$article->getId()]  ?> commentaire(s)
                                            </div>
                                        </div>

                                        <a href="/article/<?= $article->getId() ?>">lire l'article</a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </section>
    </div>


</main>
