<h2>Connexion</h2>
<main>
    <div class="form-container">
        <form action="<?= addLink('user', 'login') ?>" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Se connecter</button>
        </form>
        <link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-connexion.css">
    </div>
</main>