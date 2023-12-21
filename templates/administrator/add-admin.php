<div class="dashboard">
    <section class="add_admin_section">
        <div class="containe">
            <?php require_once 'bar-nar-header.php' ?>
            <div class="add_admin_section_content">
                <div class="nar_included">
                    <?php require_once 'nav-bar.php' ?>
                </div>
                <div class="container">
                    <section class="article-section">
                        <h2>Créer un Administrateur pour gerer le blog</h2>
                        <?php if (isset($succes) and !is_null($succes)) { ?>
                            <span class="succes"><?= $succes ?></span>
                        <?php } ?>
                        <form class="form" method="POST" action="/administration/add-admin">
                            <div class="champ">
                                <label for="surname">Le nom <span>*</span></label>
                                <input type="text" name="surname" id="surname" class="form-control" required="required" maxlength="32">
                            </div>
                            <div class="champ">
                                <label for="name">Le Prenom <span>*</span></label>
                                <input type="text" name="name" id="name" class="form-control" required="required" maxlength="32">
                            </div>
                            <div class="champ">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required="required">
                            </div>
                            <div class="champ">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" name="password" id="password" class="form-control" required="required" maxlength="8">
                            </div>
                            <div class="champ">
                                <label for="confirm_password">Confirmez Password <span>*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required="required" maxlength="8">
                                <?php if (isset($error) and !is_null($error)) { ?>
                                    <span class="error"><?= $error ?></span>
                                <?php } ?>
                            </div>

                            <div class="field-select">
                                <select name="role" id="role">
                                    <option value="admin">admin</option>
                                    <option value="super_admin">super-admin</option>
                                </select>
                            </div>

                            <button class="form_button" type="submit" name="add-article">Ajouter</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

    </section>
</div>
