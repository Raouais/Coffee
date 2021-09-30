<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.interface.add" class="btn btn-primary">Ajouter une nouvelle interface</a>
    <br>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($interfaces as $i) : ?>
                <tr>
                    <td><?= $i->id ?></td>
                    <td> <a href="?p=admin.interface.show&id=<?= $i->id ?>" class="btn btn-info"><?= $i->name ?></a></td>
                    <td>
                        <a href="?p=admin.interface.edit&id=<?= $i->id; ?>" class="btn btn-primary">Editer</a>
                        <form action="?p=admin.interface.delete" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $i->id; ?>">
                            <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $i->name",
                                "Êtes-vous sûr de vouloir supprimer l'interface $i->name",
                                "?p=admin.interface.delete&id=$i->id"
                            );
                            ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>