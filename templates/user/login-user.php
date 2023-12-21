<main>
    <h1>login-user page</h1>
    <form class="form" action="/login" method="post">
        <?php if (!is_null($error)) { ?>
        <span class="error"><?= $error ?></span>
        <?php } ?>
        <?php if (!is_null($succes)) { ?>
        <span class="succes"><?= $succes ?></span>
        <?php } ?>
        <div class="champ">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="xxxxxxxx@gmail.com" required>
        </div>

        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Entrez un mot de passe" required>
        </div>

        <button class="form_button" type="submit">Se Connecter</button>
    </form>
</main>
