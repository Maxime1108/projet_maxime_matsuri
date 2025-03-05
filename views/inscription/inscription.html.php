<h2>Inscription</h2>
<main>
    <div class="form-container">
        <form action="<?= addLink('user','register') ?>" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="register">S'inscrire</button>
        </form>
        <link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-inscription.css">
    </div>
</main>