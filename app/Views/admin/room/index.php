<div class="container text-center">
    <h1>Administrer les Salles</h1>
<p>
    <a href="?p=admin.room.add" class="btn btn-success">Ajouter</a>
</p>
<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $room):?>
            <tr>
                <td><?= $room->id?></td>
                <td> <a href="?p=admin.room.show&id=<?= $room->id?>" class="btn btn-info"><?= $room->name?></a></td> 
                <td>
                    <a href="?p=admin.room.edit&id=<?= $room->id;?>" class="btn btn-primary">Editer</a>
                    <form action="?p=admin.room.delete" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $room->id;?>">
                        <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $room->name",
                                "Êtes-vous sûr de vouloir supprimer la salle $room->name et toutes ses tables ?",
                                "?p=admin.room.delete&id=$room->id"
                            ); 
                        ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>