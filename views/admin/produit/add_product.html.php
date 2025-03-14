<h2>Ajout produit</h2>

<link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style-add-product.css'; ?>">


<form action="<?= addlink('admin/produitAdmin', 'addProduct') ?>" method="POST" enctype="multipart/form-data">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="prix">Prix</label>
        <input type="text" name="prix">
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image">  
    </div>
    <div>
        <label for="categorie">Categorie</label>
        <select name="categorie" id="categorie">
            <option value="Jeux Videos">Jeux Vidéos</option>
            <option value="Mangas">Mangas</option>
            <option value="Accessoires">Accessoires</option>
            <option value="vetements">Vetements Traditionnels</option>
        </select>
    </div>
    <div>
        <input type="submit" value="Enregistrer le produit" name="add_admin_product">
    </div>
</form>