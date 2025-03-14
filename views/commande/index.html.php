<h1>Récapitulatif Commande</h1>

<table style="min-height: 50vh">
    <thead>
        <tr>
            <th>Image du produit</th>
            <th>
                Produit
            </th>
            <th>Prix</th>
            <th></th>
            <th>Quantité</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($panier as $item) { ?>
            <tr style="text-align : center;">
                <td><img src="<?= ROOT . 'public/assets/img/' . $item['produit']->getImage(); ?>" alt="<?= $item['produit']->getTitle(); ?>" style="width: 100px;"></td>
                <td><?= $item['produit']->getTitle(); ?></td>
                <td><?= $item['produit']->getPrix(); ?>€</td>
                <td><?= $item['quantite'] ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>

<div>
    <button><a href="<?= addLink('commande', 'confirmation'); ?>">Confirmer la commande</a></button>
</div>