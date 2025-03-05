<h2>PRODUITS</h2>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-list.css">
</head>
<div>
    <h3><a href="<?= addLink('admin/produitAdmin', 'addProduct'); ?>">Ajouter un produit</a></h3>
</div>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Prix</th>
            <th>Categorie</th>
            <th colspan="2"> Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $p) { ?>
            <tr>
                <td><?= $p->getId(); ?></td>
                <td><?= $p->getTitle(); ?></td>
                <td><img src="<?= ROOT . 'public/assets/img/' .  $p->getImage(); ?>" alt="<?= $p->getTitle() . ' image' ?>"></td>
                <td><?= $p->getPrix() ?></td>
                <td><?= $p->getCategorie(); ?></td>
                <td><a href="<?= addLink('admin/produitAdmin', 'edit'); ?>">Editer</a></td>
                <td><a href="<?= addlink('admin/produitAdmin', 'delete'); ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>