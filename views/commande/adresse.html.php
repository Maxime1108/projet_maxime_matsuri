<h1>Adresse de livraison</h1>
<link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style-adresse.css'; ?>">
<!-- Formulaire adresse de livraison -->
<form method="post">
    <div>
        <label for="adresse">Votre adresse *</label>
        <input type="text" name="adresse" id="adresse" required>
    </div>
    <div>
        <label for="ville">Ville *</label>
        <input type="text" name="ville" id="ville" required>
    </div>
    <div>
        <label for="cp">code postal *</label>
        <input type="text" name="code_postal" id="cp" required>
    </div>
    <div>
        <label for="pays">Pays *</label>
        <input type="text" name="pays" id="pays" required>
    </div>
    <button type="submit" name="addAdresse"> Valider l'adresse</button>
</form>