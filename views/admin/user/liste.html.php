<h2>Utilisateurs</h2>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>username</th>
            <th>email</th>
            <th>role</th>
            <th colspan="2"> Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $$u) { ?>
            <tr>
                <td><?= $$u->getId(); ?></td>
                <td><?= $$u->getUsername(); ?></td>
                <td><?= $u->getEmail(); ?></td>
                <td><?= $$u->getRole(); ?></td>
                <td><a href="<?= addLink('admin/$produitAdmin', 'edit'); ?>">Ajouter/Supprimer droits admin</a></td>
                <td><a href="<?= addlink('admin/$produitAdmin', 'delete'); ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>