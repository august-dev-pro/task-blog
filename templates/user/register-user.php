<main>
    <h1>register-user page</h1>

    <form class="form" action="/register" method="post" enctype="multipart/form-data">
        <div class="champ">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" placeholder="Entrez votre Nome" required>
        </div>

        <div class="champ">
            <label for="surname">Prenoms</label>
            <input type="text" name="surname" id="surname" placeholder="Entrez vos Prenoms">
        </div>

        <div class="champ">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="xxxxxxxx@gmail.com" required>
        </div>


        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Entrez un mot de passe" required>
        </div>

        <div class="champ">
            <label for="password_confirm">confirmez le mot de passe</label>
            <input type="password_confirm" name="password_confirm" id="password_confirm"
                placeholder="confirmez le mot de passe" required>
            <?php if (isset($error) and !is_null($error)) { ?>
            <span class="error"><?= $error ?></span>
            <?php } ?>
        </div>
        <div class="champ">
            <label for="profi_tof">choisissez une photo de profil(facultatif)</label>
            <input type="file" name="profil">
        </div>

        <button class="form_button" type="submit">VAlider</button>
    </form>
</main>
